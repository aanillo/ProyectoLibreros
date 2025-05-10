<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;

class PurchaseController extends Controller
{
    public function create(Request $request)
    {
        $book = Book::findOrFail($request->book_id);
        return view('purchaseCheckout', ['book' => $book]);
    }

    public function store(Request $request)
{
    $request->validate([
        'book_id' => 'required|exists:books,id',
        'quantity' => 'required|integer|min:1',
        'payment_method' => 'required|in:card,paypal',
        'address' => 'required|string', // Add address validation
    ]);

    $book = Book::findOrFail($request->book_id);
    $user = Auth::user();
    $totalPrice = $book->precio * $request->quantity;

    $purchase = Purchase::create([
        'user_id' => $user->id,
        'total_price' => $totalPrice,
        'address' => $request->address, 
    ]);

    $purchase->books()->attach($book->id, [
        'quantity' => $request->quantity,
        'price_at_purchase' => $book->precio,
    ]);

    return $this->processStripePayment($purchase, $totalPrice);
}

    private function processStripePayment($purchase, $totalPrice)
{
    try {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $totalPrice * 100,
            'currency' => 'eur',
            'payment_method_types' => ['card'],
        ]);

        if (in_array($paymentIntent->status, ['requires_payment_method', 'requires_confirmation'])) {
            return view('stripe', [
                'clientSecret' => $paymentIntent->client_secret,
                'purchase' => $purchase,
            ]);
        }

        if ($paymentIntent->status === 'succeeded') {
            return redirect()->route('purchase.success', ['purchase' => $purchase->id]);
        }

        \Log::error('Stripe payment failed with status: ' . $paymentIntent->status);
        return redirect()->route('purchase.failure', ['purchase' => $purchase->id])
            ->with('error', 'Payment failed: ' . $paymentIntent->status);

    } catch (\Exception $e) {
        \Log::error('Stripe error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error processing payment: ' . $e->getMessage());
    }
}

    public function success(Purchase $purchase)
{
    return view('success', ['purchase' => $purchase]);
}

public function failure(Purchase $purchase)
{
    return view('cancel', ['purchase' => $purchase]);
}

public function checkoutAll(Request $request)
{
    $cart = $request->user()->cart;
    return view('purchaseCheckoutAll', ['cart' => $cart]);
}

public function storeAll(Request $request)
{
    $request->validate([
        'address' => 'required|string',
        'payment_method' => 'required|in:card,paypal',
        'book_ids' => 'required|array',
        'quantities' => 'required|array',
        'book_ids.*' => 'exists:books,id',
        'quantities.*' => 'integer|min:1',
    ]);

    $user = Auth::user();
    $totalPrice = 0;
    $purchase = Purchase::create([
        'user_id' => $user->id,
        'total_price' => 0, 
        'address' => $request->address,
    ]);

    foreach ($request->book_ids as $index => $bookId) {
        $book = Book::findOrFail($bookId);
        $quantity = $request->quantities[$index];
        $totalPrice += $book->precio * $quantity;

        $purchase->books()->attach($book->id, [
            'quantity' => $quantity,
            'price_at_purchase' => $book->precio,
        ]);
    }

    
    $purchase->update(['total_price' => $totalPrice]);

    return $this->processStripePayment($purchase, $totalPrice);
}


    
}
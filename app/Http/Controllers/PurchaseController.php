<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentIntent;
use Stripe\Stripe;


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
        'direccion' => 'required|string',
        'provincia' => 'required|string',
        'municipio' => 'required|string',
        'codigo_postal' => 'required|string',
    ]);

    $book = Book::findOrFail($request->book_id);
    $user = Auth::user();
    $totalPrice = $book->precio * $request->quantity;
    $fullAddress = $request->direccion . ', ' .
                   $request->municipio . ', ' .
                   $request->provincia . ', ' .
                   $request->codigo_postal;

    $purchase = Purchase::create([
        'user_id' => $user->id,
        'total_price' => $totalPrice,
        'address' => $fullAddress, 
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
        'direccion' => 'required|string',
        'provincia' => 'required|string',
        'municipio' => 'required|string',
        'codigo_postal' => 'required|string',
        'payment_method' => 'required|in:card',
        'book_ids' => 'required|array',
        'quantities' => 'required|array',
        'book_ids.*' => 'exists:books,id',
        'quantities.*' => 'integer|min:1',
    ]);

    $user = Auth::user();
    $totalPrice = 0;

  
    $fullAddress = $request->direccion . ', ' .
                   $request->municipio . ', ' .
                   $request->provincia . ', ' .
                   $request->codigo_postal;

    
    $purchase = Purchase::create([
        'user_id' => $user->id,
        'total_price' => 0, 
        'address' => $fullAddress,
    ]);

    
    foreach ($request->book_ids as $index => $bookId) {
        $book = Book::findOrFail($bookId);
        $quantity = $request->quantities[$index];
        $subtotal = $book->precio * $quantity;
        $totalPrice += $subtotal;

        $purchase->books()->attach($book->id, [
            'quantity' => $quantity,
            'price_at_purchase' => $book->precio,
        ]);
    }

    
    $purchase->update(['total_price' => $totalPrice]);

    $cart = Cart::where('user_id', $user->id)->first();
    if ($cart) {
        $cart->cartItems()->delete();
    }

    return $this->processStripePayment($purchase, $totalPrice);
}


public function indexPurchase() 
{
    $purchases = Purchase::with(['books:id,titulo', 'user:id,username'])->get();
    return view('purchaseAdminView', compact('purchases'));
}

public function deletePurchase($id)
{
    $purchase = Purchase::findOrFail($id);
    
    $purchase->delete();

    return redirect()->route('admin.purchases')->with('success', 'Compra eliminada correctamente.');
}
    
}
<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function index()
    {
        $cart = auth()->user()->cart()->with('cartItems.book')->first();

        return view('cartMain', compact('cart'));
    }

public function addToCart(Request $request)
{
    $request->validate([
        'book_id' => 'required|exists:books,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $user = Auth::user();

    
    $cart = Cart::firstOrCreate(
        ['user_id' => $user->id]
    );

    
    $cartItem = CartItem::where('cart_id', $cart->id)
        ->where('book_id', $request->book_id)
        ->first();

    if ($cartItem) {
        $cartItem->quantity += $request->quantity;
        $cartItem->save();
    } else {
        CartItem::create([
            'cart_id' => $cart->id,
            'book_id' => $request->book_id,
            'quantity' => $request->quantity,
        ]);
    }

    return redirect()->back()->with('success', 'Libro añadido al carrito correctamente.');
}

}

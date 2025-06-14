<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Vista para insertar elemento al carro 

    public function index()
    {
        $cart = auth()->user()->cart()->with('cartItems.book')->first();

        return view('cartMain', compact('cart'));
    }


// añadir al carro 

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


// eliminar libro del carro

public function remove($item_id)
{
    $user = Auth::user();

    $cart = Cart::where('user_id', $user->id)->first();

    if (!$cart) {
        return redirect()->back()->with('error', 'Carrito no encontrado.');
    }

    
    $cartItem = CartItem::where('cart_id', $cart->id)
                        ->where('id', $item_id)  
                        ->first();

    
    if ($cartItem) {
        $cartItem->delete();
        return redirect()->back()->with('success', 'Libro eliminado del carrito correctamente.');
    } else {
        return redirect()->back()->with('error', 'El libro no está en tu carrito.');
    }
}


}

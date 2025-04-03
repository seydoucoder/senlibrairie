<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, Book $book)
    {
        $quantity = $request->quantity ?? 1;
        $cart = session()->get('cart', []);
        
        if (isset($cart[$book->id])) {
            $cart[$book->id]['quantity'] += $quantity;
        } else {
            $cart[$book->id] = [
                'titre' => $book->titre,
                'prix' => $book->prix,
                'quantity' => $quantity,
                'image' => $book->image
            ];
        }
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Livre ajouté au panier!');
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['prix'] * $item['quantity'];
        }
        return view('cart.show', compact('cart', 'total'));
    }

    public function removeFromCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Livre retiré du panier!');
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();

        return view('cart.index', [
            'cartItems' => $cartItems,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($product_id)
    {
        $cartItem = Cart::where('user_id', auth()->user()->id)
            ->where('product_id', $product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $product_id,
                'quantity' => 1,
            ]);
        }

        return response()->json([
            'message' => 'Product added to cart successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($cart_id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cart_id)
    {
        //
    }
}

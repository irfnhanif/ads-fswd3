<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        $isAdmin = auth()->user()->is_admin;
        return view('products.index', [
            'products' => $products,
            'isAdmin' => $isAdmin,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($product)
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $verifiedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|max:1000|nullable',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images', $imageName);

        Product::create([
            'name' => $verifiedData['name'],
            'description' => $verifiedData['description'],
            'price' => $verifiedData['price'],
            'image' => $imageName,
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($product_id)
    {
        $product = Product::find($product_id);

        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product_id)
    {
        $product = self::show($product_id);

        return view('products.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($product_id, Request $request)
    {
        $product = self::show($product_id);

        $verifiedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|max:1000|nullable',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
        ]);

        if ($request->image) {
            $oldImage = $product->image;

            if (!empty($oldImage)) {
                unlink(storage_path('app/public/images/' . $oldImage));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
        } else {
            $imageName = $product->image;
        }

        $product->update([
            'name' => $verifiedData['name'],
            'description' => $verifiedData['description'],
            'price' => $verifiedData['price'],
            'image' => $imageName,
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id)
    {
        $product = self::show($product_id);

        if (!empty($product->image)) {
            unlink(storage_path('app/public/images/' . $product->image));
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}

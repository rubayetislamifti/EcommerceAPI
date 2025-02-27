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
        return response()->json(Product::all(),200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $products = Product::create($request->all());
        return response()->json([
            'message' => 'Product created successfully!',
            'product' => $products
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string|max:500',
            'stock' => 'nullable|numeric',
        ]);

    $product->update($validated);
        return response()->json([
            'message' => 'Product updated successfully!',
            'product' => $product
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully!',
            'product' => $product
        ], 201);
    }
}

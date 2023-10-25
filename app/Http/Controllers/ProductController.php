<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a listing of the products.
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Show the form for creating a new product.
    public function create()
    {
        return view('products.create');
    }

    // Store a newly created product in the database.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    // Display the specified product.
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Show the form for editing the specified product.
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update the specified product in the database.
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Remove the specified product from the database.
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}

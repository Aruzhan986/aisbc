<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
{
    return Product::with('category')->get();
}


    public function store(ProductRequest $request)
    {
        return Product::create($request->validated());
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}

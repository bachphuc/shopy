<?php

namespace bachphuc\Shopy\Http\Controllers;

use Illuminate\Http\Request;

use bachphuc\Shopy\Facades\ShopyFacade as Shopy;
use bachphuc\Shopy\Models\Product;

class ProductController
{
    public function index(Request $request)
    {
        $products = Product::all();
        return Shopy::view('products.index', [
            'products' => $products
        ]);
    }

    public function show(Request $request, Product $product)
    {
        return Shopy::view('products.show', [
            'product' => $product
        ]);
    }

    public function create()
    {
        return Shopy::view('products.create');
    }

    public function store()
    {
        
    }

    public function edit()
    {
        return Shopy::view('products.edit');
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
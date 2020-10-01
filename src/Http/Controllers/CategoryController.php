<?php

namespace bachphuc\Shopy\Http\Controllers;

use Illuminate\Http\Request;

use bachphuc\Shopy\Facades\ShopyFacade as Shopy;
use bachphuc\Shopy\Models\Product;
use bachphuc\Shopy\Models\Address;
use bachphuc\Shopy\Models\Order;
use bachphuc\Shopy\Models\Category;

class CategoryController extends Controller
{
    public function show(Request $request){
        $category = Category::findByName($request->route('alias'));
        if(!$category){
            abort(404);
        }

        $length = $request->query('length') ? (int) $request->query('length') : 12;

        $products = Product::where('category_id', $category->id)
        ->paginate($length);

        return Shopy::view('categories.show', [
            'category' => $category,
            'products' => $products
        ]);
    }

}
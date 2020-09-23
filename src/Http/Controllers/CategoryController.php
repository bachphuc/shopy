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
    public function show(Request $request, $alias){
        $category = Category::findByName($alias);
        if(!$category){
            abort(404);
        }
        return Shopy::view('categories.show', [
            'category' => $category,
            'products' => $category->products()
        ]);
    }

}
<?php

namespace bachphuc\Shopy\Http\Components;

use bachphuc\Shopy\Models\Product;

class NewProductBlock extends ShopyBaseElement
{
    protected $viewPath = 'new-products';

    public function run($params = []){
        $products = Product::with(['category'])
        ->orderBy('created_at', 'DESC')
        ->take(12)
        ->get();

        $categories = [];
        $indexCategoryIds = [];
        foreach($products as $product){
            if($product->category && !isset($indexCategoryIds[$product->category_id])){
                $categories[] = $product->category;
                $indexCategoryIds[$product->category_id] = true;
            }
        }

        return [
            'products' => $products,
            'categories' => $categories
        ];
    }
}
<?php

namespace bachphuc\Shopy\Http\Components;

use bachphuc\Shopy\Models\Product;

class Trending extends ShopyBaseElement
{
    protected $viewPath = 'trending';

    public function run($params = []){
        $products = Product::take(3)->get();

        return [
            'cols' => [
                'hot' => [
                    'title' => trans('shopy::lang.hot_trend'),
                    'items' => $products
                ],
                'best' => [
                    'title' => trans('shopy::lang.best_seller'),
                    'items' => $products
                ],
                'feature' => [
                    'title' => trans('shopy::lang.feature'),
                    'items' => $products
                ],
            ]
        ];
    }
}
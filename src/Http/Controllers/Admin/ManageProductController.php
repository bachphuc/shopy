<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

use bachphuc\LaravelHTMLElements\Http\Controllers\ManageBaseController;

class ManageProductController extends ManageBaseController{
    protected $modelName = 'product';
    protected $model = '\bachphuc\Shopy\Models\Product';
    protected $activeMenu = 'products';
    protected $searchFields = ['title', 'description'];
    protected $modelRouteName = 'admin.products';
    // protected $authMiddleware = 'auth';
    protected $layout = 'bachphuc.shopy::admin.layouts.default';

    protected $itemDisplayField = 'title';

    public function __construct(){
        $this->formElements = [
            'title' => [
                'validator' => 'required',
                'type' => 'text',
            ],
            'description' => [
                'type' => 'text',
                'validator' => 'required',
            ],
            'price',
            'count',
            'image' => [
                'type' => 'image_input'
            ],
            'user',
            'gallery' => [
                'type' => 'GalleryImageElement'
            ]
        ];

        $this->breadcrumbs = [
            [
                'title' => 'Products',
                'url' => route($this->modelRouteName. '.index')
            ]
        ];

        $this->fields = [
            'id',
            'image' => [
                'type' => 'image'
            ],
            'title' => [
                'render' => function($item){
                    $html = '<p>'. $item->title . '</p>';
                    $html.= '<p>'. str_limit($item->description, 180) . '</p>';
    
                    return $html;
                }
            ],
            'price',
            'count',
        ];

        parent::__construct();
    }

    public function processTable(&$table){

    }
}
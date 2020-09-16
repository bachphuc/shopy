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
            'image' => [
                'type' => 'image_input'
            ],
            'user_id' => [
                'type' => 'select',
                'options' => [
                    'model' => 'user',
                    'display_field' => 'name'
                ]
            ]
        ];

        $this->breadcrumbs = [
            [
                'title' => 'Books',
                'url' => route($this->modelRouteName. '.index')
            ]
        ];

        $this->fields = [
            'id',
            'title',
            'user' => [
                'render' => function($book){
                    if(!$book->user) return '';
                    $href = route('store.users.books.index', ['user' => $book->user]);
                    $html = "<a href='{$href}'>{$book->user->name}</a>";
                    return $html;
                }
            ],
            'description',
            'image' => [
                'type' => 'image'
            ]
        ];

        parent::__construct();
    }

    public function processTable(&$table){

    }
}
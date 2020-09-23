<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

class ManageCategoryController extends ManageBaseController{
    protected $modelName = 'category';
    protected $model = '\bachphuc\Shopy\Models\Category';
    protected $activeMenu = 'categories';
    protected $searchFields = ['title', 'description'];
    protected $modelRouteName = 'admin.categories';
    // protected $authMiddleware = 'auth';

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
            'parent_category_id' => [
                'type' => 'select',
                'options' => [
                    'model' => '\bachphuc\Shopy\Models\Category',
                ]
            ],
            'image' => [
                'type' => 'image_input',
                'thumbnail' => true
            ],
            'user',
            'gallery' => [
                'type' => 'GalleryImageElement'
            ],
            'alias' => 'title'
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
            'total_product',
        ];

        parent::__construct();
    }

    public function processTable(&$table){

    }
}
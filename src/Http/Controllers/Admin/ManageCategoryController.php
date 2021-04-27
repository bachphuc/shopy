<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

use Illuminate\Http\Request;

class ManageCategoryController extends ManageBaseController{
    protected $modelName = 'category';
    protected $model = '\bachphuc\Shopy\Models\Category';
    protected $activeMenu = 'categories';
    protected $searchFields = ['title', 'description'];
    protected $modelRouteName = 'admin.categories';
    protected $modelWiths = ['category'];
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
                'default_value' => 0,
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
                'title' => 'Categories',
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
                    $html = '<p><a href="' . $item->getHref() . '">' . $item->title . '</a> <a href="'. $item->getAdminHref() .'">('. $item->total_product .' '. trans('shopy::lang.products') .')</a></p>';
                    $html.= '<p>'. str_limit($item->description, 180) . '</p>';
    
                    return $html;
                }
            ],
            'category' => [
                'title' => trans('shopy::lang.parent_category'),
                'render' => function($item){
                    if(!$item->category) return;
                    return $item->category->getTitle();
                }
            ]
        ];

        parent::__construct();
    }

    public function processTable(&$table){

    }

    public function afterUpdate(Request $request, $item){
        $item->updateTotalProducts();
    }

    public function initFormInput($isUpdate = false){
        parent::initFormInput($isUpdate);

        $this->form->setAttribute('ajax', true);
    }
}
<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

use bachphuc\LaravelHTMLElements\Components\Form;
use bachphuc\LaravelHTMLElements\Components\ViewGroup;
use bachphuc\LaravelHTMLElements\Components\Section;
use CustomField;

use bachphuc\Shopy\Models\Product;

class ManageProductController extends ManageBaseController{
    protected $modelName = 'product';
    protected $model = '\bachphuc\Shopy\Models\Product';
    protected $activeMenu = 'products';
    protected $searchFields = ['title', 'description'];
    protected $modelRouteName = 'admin.products';
    protected $modelWiths = ['category'];

    protected $itemDisplayField = 'title';

    public function getBreadcrumbs(){
        $this->breadcrumbs = [
            [
                'title' => 'Products',
                'url' => route($this->modelRouteName. '.index')
            ]
        ];
    }

    public function createTableFields(){
        return [
            'id',
            'image' => [
                'type' => 'image'
            ],
            'title' => [
                'render' => function($item){
                    $html = '<p><a target="_blank" href="'. $item->getHref() .'">'. $item->title . '</a></p>';
                    $html.= '<p>'. str_limit($item->description, 180) . '</p>';
    
                    return $html;
                }
            ],
            'category' => [
                'render' => function($item){
                    if(!$item->category) return '';
                    return $item->category->getTitle();
                }
            ],
            'price',
            'count',
        ];
    }

    public function processTable(&$table){

    }

    public function createFormElements($isUpdate = false){
        $customElement = '\bachphuc\LaravelCustomFields\Components\CustomFieldElement';
        $elements = [
            'title' => [
                'validator' => 'required',
                'type' => 'text',
            ],
            'description' => [
                'type' => 'text_content',
                'validator' => 'required',
            ],
            'category_id' => [
                'type' => 'select',
                'options' => [
                    'model' => 'shopy_category'
                ]
            ],
            'group_2' => [
                'type' => 'form_group',
                'children' => [
                    'price',
                    'count'
                ]
            ],
            'image' => [
                'type' => 'image_input'
            ],
            'user',
            'gallery' => [
                'type' => 'GalleryImageElement'
            ],
            'alias' => 'title',
            'group_3' => [
                'type' => 'form_group',
                'children' => [
                    'is_hot' => [
                        'type' => 'checkbox'
                    ],
                    'is_new' => [
                        'type' => 'checkbox',
                    ],
                    'is_featured' => [
                        'type' => 'checkbox'
                    ],
                ]
            ],
        ];

        $fields = CustomField::field('shopy_product');
        foreach($fields as $field){
            $elements[$field->alias] = $field->element();
        }
        return $elements;
    }

    public function editHook($item){

        $items = Product::all();

        $component = new ViewGroup();
        $component->setTheme($this->getTheme());

        $component->setChildren([
            [
                'type' => 'button',
                'title' => 'Create a new Product Variant',
                'tag' => 'a',
                'href' => route('admin.products.variants.index', [
                    'product' => $item
                ])
            ], [
                'type' => 'table',
                'fields' => [
                    'image' => ['type' => 'image'], 'id', 'title'
                ],
                'items' => $items
            ]
        ]);

        $this->forms[] = [
            'title' => 'Variants',
            'key' => 'variants',
            'form' => $component
        ];
    }
}
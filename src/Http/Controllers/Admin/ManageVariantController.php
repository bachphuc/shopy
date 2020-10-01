<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

use bachphuc\LaravelHTMLElements\Components\Form;
use bachphuc\LaravelHTMLElements\Components\ViewGroup;
use bachphuc\LaravelHTMLElements\Components\Section;
use CustomField;

use Illuminate\Http\Request;
use bachphuc\Shopy\Models\Product;

class ManageVariantController extends ManageBaseController{
    protected $modelName = 'variant';
    protected $model = '\bachphuc\Shopy\Models\ProductVariant';
    protected $activeMenu = 'products';
    protected $searchFields = ['title', 'description'];
    protected $modelRouteName = 'admin.products.variants';

    protected $itemDisplayField = 'title';
    protected $subjectRouteName = 'variant';

    protected $mapModelClasses = [
        'product' => 'shopy_product',
        'variant' => 'shopy_product_variant',
    ];

    public function initBreadcrumb(){
        $this->breadcrumbs = [
            [
                'title' => 'Manage Products',
                'url' => route('admin.products.index'),
            ],
            [
                'title' => $this->routeParams['product']->getTitle(),
                'url' => route('admin.products.show', $this->routeParams)
            ],
            [
                'title' => 'Manage Variants',
                'url' =>  route($this->modelRouteName. '.index', $this->routeParams)
            ]
        ];

        return $this->breadcrumbs;
    }

    public function createTableFields(){
        $fields = [
            'image' => [
                'type' => 'image'
            ],
            'id', 
        ];

        $customFields = CustomField::field('shopy_product', [
            'field_type' => 'select_multi'
        ]);

        foreach($customFields as $field){
            $fields[$field->alias] = [
                'render' => function($item) use($field){
                    return $item->getField($field->alias);
                }
            ];
        }

        return array_merge($fields, [
            'price',
            'count'
        ]);
    }

    public function processTable(&$table){

    }

    public function processQuery(Request $request, &$query){
        $query->where('product_id', $this->routeParams['product']->id);
    }

    public function createFormElements($isUpdate = false){
        $defaults = [
            'product_id' => [
                'type' => 'hidden',
                'value' => $this->routeParams['product']->id
            ],
            'user',
            'price' => [
                'value' => $this->routeParams['product']->price
            ],
            'count' => [
                'type' => 'text',
                'default' => 0
            ],
            'is_sold_out' => [
                'type' => 'checkbox'
            ],
            'is_disabled' => [
                'type' => 'checkbox'
            ]
        ];

        $fields = CustomField::field('shopy_product', [
            'field_type' => 'select_multi'
        ]);

        $customFields = [
            'image' => [
                'type' => 'image_input'
            ]
        ];
        foreach($fields as $field){
            $tmp = [
                'validator' => 'required',
                'type' => 'select',
                'options' => [
                    'data' => $field->getOptions()
                ]
            ];
            if($isUpdate){
                $tmp['value'] = $this->subject->getField($field->alias);
            }
            $customFields[$field->alias] = $tmp;
        }   

        return array_merge($customFields, $defaults);
    }

    public function editHook($item){

    }

    public function afterStore(Request $request, $item, $data){
        $fields = CustomField::field('shopy_product', [
            'field_type' => 'select_multi'
        ]);

        $customFields = [];

        $customFieldValues = [];
        $customFieldNames = [];
        $searchValues = [];
        $searchNames = [];
        $searches = [];
        foreach($fields as $field){
           if(isset($data[$field->alias])){
                $customFieldValues[] = $data[$field->alias];
                $searchValues[] = '['. $data[$field->alias] . ']';
                $searchNames[] = '['. $field->alias . ']';

                $customFieldNames[] = $field->alias;

                $searches[] = '[' . $field->alias . '|' . $data[$field->alias] . ']';
           }
        }  

        if(!empty($customFieldValues)){
            $item->fields = implode(',', $customFieldNames);
            $item->values = implode(',', $customFieldValues);

            $item->search_values = implode(',', $searchValues);
            $item->search_fields = implode(',', $searchNames);

            $item->search = implode(',', $searches);
            $item->save();
        }

        if($item->product){
            $item->product->updateTotalVariants();
        }
    }

    public function afterUpdate(Request $request, $item){
        if($item->product){
            $item->product->updateTotalVariants();
        }
    }
}
<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

use bachphuc\LaravelHTMLElements\Components\Form;
use bachphuc\LaravelHTMLElements\Components\ViewGroup;
use bachphuc\LaravelHTMLElements\Components\Section;
use CustomField;

use bachphuc\Shopy\Models\Product;
use bachphuc\Shopy\Models\ProductVariant;
use Illuminate\Http\Request;

class ManageProductController extends ManageBaseController{
    protected $modelName = 'product';
    protected $model = '\bachphuc\Shopy\Models\Product';
    protected $activeMenu = 'products';
    protected $searchFields = ['title', 'description'];
    protected $modelRouteName = 'admin.products';
    protected $modelWiths = ['category'];

    protected $itemDisplayField = 'title';

    public function initBreadcrumb(){
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
                    $html = '<p>(' . $item->total_variants . ' '. trans('shopy::lang.variants') .') <a target="_blank" href="'. $item->getHref() .'">'. $item->title . '</a></p>';
                    $html.= '<p>'. str_limit(strip_tags($item->description), 180) . '</p>';
    
                    return $html;
                }
            ],
            'category' => [
                'render' => function($item){
                    if(!$item->category) return '';
                    return $item->category->getTitle();
                }
            ],
            'price' => [
                'render' => function($item){
                    return $item->displayPrice();
                }
            ],
            'count',
        ];
    }

    public function processTable(&$table){
        $table->setAttribute('disableEditModalMode', true);
    }

    public function createFormElements($isUpdate = false){
        $customElement = '\bachphuc\LaravelCustomFields\Components\CustomFieldElement';
        $elements = [
            'title' => [
                'validator' => 'required',
                'type' => 'text',
            ],
            'description' => [
                'type' => 'text_editor',
                'validator' => 'required',
                'allow_upload_image' => true,
                'upload_image_url' => route('tinymce.image.upload')
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
            'form_group->' => [
                'is_hot' => [
                    'type' => 'checkbox'
                ],
                'is_new' => [
                    'type' => 'checkbox',
                ],
                'is_featured' => [
                    'type' => 'checkbox'
                ],
            ],
        ];

        $fields = CustomField::field('shopy_product');
        foreach($fields as $field){
            $elements[$field->alias] = $field->element();
        }
        return $elements;
    }

    public function initFormInput($isUpdate = false){
        parent::initFormInput($isUpdate);

        $this->form->setAttribute('ajax', true);
    }

    public function editHook($item){
        // create table
        $items = ProductVariant::where('product_id', $item->id)
        ->get();

        $variantTableFields = [
            'image' => [
                'type' => 'image'
            ],
            'id', 
        ];

        $customFields = CustomField::field('shopy_product', [
            'field_type' => 'select_multi'
        ]);

        foreach($customFields as $field){
            $variantTableFields[$field->alias] = [
                'render' => function($item) use($field){
                    return $item->getField($field->alias);
                }
            ];
        }

        $variantTableFields[] = 'price';
        $variantTableFields[] = 'count';


        $component = new ViewGroup();
        $component->setTheme($this->getTheme());

        $component->setChildren([
            [
                'type' => 'button',
                'title' => 'Create a new Product Variant',
                'tag' => 'a',
                'class' => 'btn-success',
                'href' => route('admin.products.variants.create', [
                    'product' => $item
                ])
            ], [
                'type' => 'table',
                'fields' => $variantTableFields,
                'items' => $items,
                'isShowActionButtons' => true,
                'model_route_name' => 'admin.products.variants',
                'route_params' => [
                    'product' => $item
                ]
            ]
        ]);

        $this->forms[] = [
            'title' => 'Variants',
            'key' => 'variants',
            'form' => $component
        ];
    }

    public function afterStore(Request $request, $item, $data){
        if($item->category){
            $item->category->updateTotalProducts();
        }
    }

    public function afterUpdate(Request $request, $item){
        if($item->category){
            $item->category->updateTotalProducts();
        }
    }
}
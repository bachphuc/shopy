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
                'title' => shopy_trans('lang.image'),
                'type' => 'image'
            ],
            'title' => [
                'title' => shopy_trans('lang.product_title'),
                'render' => function($item){
                    $html = '<p>(' . $item->total_variants . ' '. trans('shopy::lang.variants') .') <a target="_blank" href="'. $item->getHref() .'">'. $item->title . '</a></p>';
                    $html.= '<p>'. str_limit(strip_tags($item->description), 180) . '</p>';

                    if($item->isRemoveFromSale()){
                        $html.= '<div><label class="label label-danger">'. shopy_trans('lang.remove_from_sale') .'</label></div>';
                    }
                    else{
                        $html.= '<div><label class="label label-success">'. shopy_trans('lang.product_selling') .'</label></div>';
                    }
    
                    return $html;
                }
            ],
            'category' => [
                'title' => shopy_trans('lang.product_category'),
                'render' => function($item){
                    if(!$item->category) return '';
                    return $item->category->getTitle();
                }
            ],
            'price' => [
                'title' => shopy_trans('lang.price'),
                'render' => function($item){
                    return $item->displayPrice();
                }
            ],
            'count' => [
                'title' => shopy_trans('lang.count')
            ],
            'status' => [
                'title' => shopy_trans('lang.status'),
                'render' => function($item){
                    $label = 'warning';
                    if($item->status === 'published'){
                        $label = 'success';
                    }
                    else if($item->status === 'removed'){
                        $label = 'danger';
                    }
                    $html = '<label class="label label-'. $label .'">'. shopy_trans('lang.product_' . $item->status) .'</label>';

                    return $html;
                }
            ]
        ];
    }

    public function processTable(&$table){
        $table->setAttribute('disableEditModalMode', true);
    }

    public function createFormElements($isUpdate = false){
        $customElement = '\bachphuc\LaravelCustomFields\Components\CustomFieldElement';
        $elements = [
            'title' => [
                'title' => shopy_trans('lang.product_title'),
                'validator' => 'required',
                'type' => 'text',
            ],
            'description' => [
                'title' => shopy_trans('lang.product_desc'),
                'type' => 'text_editor',
                'validator' => 'required',
                'allow_upload_image' => true,
                'upload_image_url' => route('tinymce.image.upload')
            ],
            'category_id' => [
                'title' => shopy_trans('lang.product_category'),
                'type' => 'select',
                'options' => [
                    'model' => 'shopy_category'
                ]
            ],
            'group_2' => [
                'type' => 'form_group',
                'children' => [
                    'price' => [
                        'title' => shopy_trans("lang.price")
                    ],
                    'count' => [
                        'title' => shopy_trans('lang.count')
                    ]
                ]
            ],
            'image' => [
                'title' => shopy_trans('lang.product_avatar'),
                'type' => 'image_input'
            ],
            'user',
            'gallery' => [
                'title' => shopy_trans('lang.product_image'),
                'type' => 'GalleryImageElement'
            ],
            'alias' => 'title',
            'form_group->' => [
                'is_hot' => [
                    'title' => shopy_trans('lang.hot_product'),
                    'type' => 'checkbox'
                ],
                'is_new' => [
                    'title' => shopy_trans('lang.new_product'),
                    'type' => 'checkbox',
                ],
                'is_featured' => [
                    'title' => shopy_trans('lang.featured_product'),
                    'type' => 'checkbox'
                ],
            ],
            'is_remove_from_sale' => [
                'title' => shopy_trans('lang.remove_from_sale'),
                'type' => 'checkbox'
            ],
            'status' => [
                'title' => shopy_trans('lang.status'),
                'type' => 'select',
                'options' => [
                    'data' => Product::STATUSES
                ]
            ]
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
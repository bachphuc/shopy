<?php

namespace bachphuc\Shopy\Http\Controllers;

use Illuminate\Http\Request;

use bachphuc\Shopy\Facades\ShopyFacade as Shopy;
use bachphuc\Shopy\Models\Product;

use CustomField;

class ProductController extends Controller
{
    protected $breadcrumbs = [];

    public function __construct() {

        $this->breadcrumbs = [
            [
                'title' => trans('shopy::lang.home'),
                'url' => url(''),
                'icon' => '<i class="fa fa-home"></i>'
            ],
            [
                'title' => trans('shopy::lang.products'),
                'url' => Shopy::route('products.index')
            ]
        ];
    }

    public function index(Request $request)
    {
        $params = $request->all();

        $products = Product::all();
        return Shopy::view('products.index', [
            'products' => $products,
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    // public function show(Request $request, Product $product)
    public function show(Request $request)
    {
        $product = Product::findOrFail($request->route('product'));

        return $this->showProduct($request, $product);
    }

    public function showProduct(Request $request, Product $product)
    {
        if($product->category){
            $this->breadcrumbs[] = [
                'title' => $product->category->getTitle(),
                'url' => $product->category->getHref()
            ];
        }
        
        $this->breadcrumbs[] = [
            'title' => $product->getTitle(),
        ];

        $customFields = CustomField::field('shopy_product', [
            'field_type' => 'select_multi'
        ]);

        $variants = $product->getVariants();

        meta_subject($product);

        return Shopy::view('products.show', [
            'product' => $product,
            'customFields' => $customFields,
            'variants' => $variants,
            'selectedVariant' => $variants->get(0),
            'breadcrumbs' => $this->breadcrumbs,
            'arrCustomFields' => CustomField::convertFieldsToArray($customFields)
        ]);
    }

    public function detail(Request $request){
        $product = Product::findByName($request->route('alias'));

        if(!$product) {
            abort(404);
        }

        return $this->showProduct($request, $product);
    }

    public function create()
    {
        return Shopy::view('products.create');
    }

    public function store()
    {
        
    }

    public function edit()
    {
        return Shopy::view('products.edit');
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
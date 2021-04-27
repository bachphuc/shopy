<?php

namespace bachphuc\Shopy;

use bachphuc\Shopy\Version;
use bachphuc\Shopy\Models\Cart;
use bachphuc\Shopy\Models\Address;
use bachphuc\Shopy\Models\Category;

class Shopy
{
    protected $version = null;
    protected $customLayout = null;
    protected $layout = 'default';
    protected $theme = 'default';
    protected $adminLayout = 'default';

    protected $_cart = null;
    protected $_categories = null;
    protected $_shop = null;

    public function __construct(Version $version)
    {   
        $this->version = $version;
    }

    public function view($path, $data = [])
    {
        return view($this->viewPath($path), $data);        
    }

    public function viewPath($path)
    {
        return 'shopy::templates.'. $this->theme . '.' . $path;
    }

    public function adminView($path, $data = [])
    {
        return view($this->adminViewPath($path), $data);        
    }

    public function adminViewPath($path){
        return 'shopy::admin.'. $this->theme . '.' . $path;
    }

    public function setLayout($layout)
    {
        $this->customLayout = $layout;
    }

    public function layout()
    {
        if(!empty($this->customLayout)) return $this->customLayout;
        return 'shopy::templates.' . $this->theme . '.layouts.' . $this->layout;
    }

    public function setAdminLayout($layout){
        $this->adminLayout = $layout;
    }

    public function adminLayout(){
        if(is_modal_request()){
            return 'bachphuc.elements::layouts.blank';
        }
        return 'bachphuc.elements::layouts.admin';
    }

    public function cart(){
        if($this->_cart !== null) return $this->_cart;

        $this->_cart = Cart::where('user_id', user_id())
        ->first();

        if(!$this->_cart){
            // create a new cart
            $this->_cart = Cart::create([
                'user_id' => user_id(),
                'count' => 0,
                'amount' => 0
            ]);
        }

        return $this->_cart;
    }

    public function cartTotal(){
        return $this->cart()->count;
    }

    public function cartAmount(){
        return (int) $this->cart()->amount;
    }

    public function displayCartAmount(){
        return number_format($this->cartAmount(), 0, ',', '.') . ' VNĐ';
    }

    public function userShippingAddresses(){
        return Address::getUserAddresses();
    }

    public function categories(){
        if($this->_categories !== null) return $this->_categories;

        $this->_categories = Category::all();

        return $this->_categories;
    }

    public function parentCategories(){
        return Category::where('parent_category_id', 0)
        ->get();
    }

    public function asset($path){
        return asset('assets/templates/default/' . $path);
    }

    public function adminAsset($path){
        return asset('assets/templates/default/admin/' . $path);
    }

    public function route($path, $params = []){
        $request = request();
        $shop = $request->route('shop');
        if(!empty($shop)){
            $params['shop'] = $shop;
            $routeName = $request->route()->getName();
            if(strpos($routeName, 'shop.') === 0){
                $path = 'shop.' . $path;
            }
        }
        return route($path, $params);
    }

    public function adminRoute($path, $params = []){
        return route('admin.' . $path, $params);
    }

    public function addressesOf($user = null){
        return Address::getAddressesOf($user);
    }

    public function getAdminMenus(){
        return [
            [
                'title' => 'Dashboard',
                'icon' => 'dashboard',
                'url' => url('admin'),
                'key' => 'dashboard',
            ], [
                'title' => 'Orders',
                'icon' => 'list_alt',
                'key' => 'orders',
                'subs' => [
                    [
                        'title' => trans('shopy::lang.pending_orders'),
                        'url' => url('admin/orders?status=pending'),
                        'key' => 'pending_orders',
                        'icon' => 'list_alt',
                    ]
                    , [
                        'title' => trans('shopy::lang.all_orders'),
                        'url' => url('admin/orders'),
                        'key' => 'all_orders',
                        'icon' => 'list_alt',
                    ]
                ]
            ], [
                'title' => 'Categories',
                'icon' => 'category',
                'url' => route('admin.categories.index'),
                'key' => 'categories',
            ], [
                'title' => 'Products',
                'icon' => 'dashboard',
                'url' => route('admin.products.index'),
                'key' => 'products',
            ], [
                'title' => 'Customers',
                'icon' => 'supervised_user_circle',
                'url' => route('admin.customers.index'),
                'key' => 'customers',
            ], [
                'title' => 'Reports',
                'icon' => 'bar_chart',
                'url' => url('admin/reports'),
                'key' => 'reports',
            ],[
                'title' => 'Fields',
                'icon' => 'dashboard',
                'url' => route('admin.fields.index'),
                'key' => 'fields'
            ], [
                'title' => 'Settings',
                'icon' => 'settings',
                'url' => url('admin/settings'),
                'key' => 'settings'
            ]
        ];
    }
}
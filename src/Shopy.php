<?php

namespace bachphuc\Shopy;

use bachphuc\Shopy\Version;
use bachphuc\Shopy\Models\Cart;
use bachphuc\Shopy\Models\Address;
use bachphuc\Shopy\Models\Category;
use bachphuc\Shopy\Models\Product;
use LaravelTheme;

class Shopy
{
    protected $version = null;
    protected $customLayout = null;
    protected $layout = 'default';
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
        $viewConfig = config('shopy.views');
        if(!empty($viewConfig) && isset($viewConfig[$path]) && !empty($viewConfig[$path])){
            return $viewConfig[$path];
        }
        return LaravelTheme::viewPath($path, 'shopy');
    }

    public function adminView($path, $data = [])
    {
        return view($this->adminViewPath($path), $data);        
    }

    public function getTemplate(){
        return LaravelTheme::getTemplate();
    }

    public function adminViewPath($path){
        return LaravelTheme::adminViewPath($path, 'shopy');
    }

    public function setLayout($layout)
    {
        $this->customLayout = $layout;
    }

    public function layout()
    {
        return LaravelTheme::layout('shopy');
    }

    public function setAdminLayout($layout){
        $this->adminLayout = $layout;
    }

    public function adminLayout(){
        if(is_modal_request()){
            return 'elements::layouts.blank';
        }
        return 'elements::layouts.admin';
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
        return asset('vendor/shopy/assets/templates/default/' . $path);
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

    public function config($key, $default = null){
        $value = config('shopy.' . $key);
        if(empty($value)) return $default;
        return $value;
    }

    public function siteLogo(){
        $config = $this->config('site_logo');
        if(!empty($config)) return $config;

        return $this->asset('img/logo.png');
    }

    public function siteName(){
        return $this->config('site_name');
    }

    public function trans($value, $default = ''){
        $key = strtolower($value);
        if(\Lang::has($key)) return trans($key);
        if(\Lang::has('shopy::' . $key)) return trans('shopy::' . $key);
        if(\Lang::has('shopy::lang.' . $key)) return trans('shopy::lang.' . $key);
        if(!empty($default)) return $default;

        return $value;
    }

    public function getAdminMenus(){
        return [
            [
                'title' => 'Dashboard',
                'icon' => 'dashboard',
                'url' => url('admin'),
                'key' => 'dashboard',
                'position' => 0
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
                'key' => 'settings',
                'position' => 10
            ]
        ];
    }

    public function products($params = []){
        $length = isset($params['length']) ? (int) $params['length'] : 8;
        
        return Product::orderBy('id', 'DESC')
        ->take($length)
        ->get();
    }
}
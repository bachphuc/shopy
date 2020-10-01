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
        return 'bachphuc.shopy::templates.'. $this->theme . '.' . $path;
    }

    public function adminView($path, $data = [])
    {
        return view($this->adminViewPath($path), $data);        
    }

    public function adminViewPath($path){
        return 'bachphuc.shopy::admin.'. $this->theme . '.' . $path;
    }

    public function setLayout($layout)
    {
        $this->customLayout = $layout;
    }

    public function layout()
    {
        if(!empty($this->customLayout)) return $this->customLayout;
        return 'bachphuc.shopy::templates.' . $this->theme . '.layouts.' . $this->layout;
    }

    public function setAdminLayout($layout){
        $this->adminLayout = $layout;
    }

    public function adminLayout(){
        return 'bachphuc.shopy::admin.' . $this->theme . '.layouts.' . $this->adminLayout;
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
        return $this->cart()->amount;
    }

    public function userShippingAddresses(){
        return Address::getUserAddresses();
    }

    public function categories(){
        if($this->_categories !== null) return $this->_categories;

        $this->_categories = Category::all();

        return $this->_categories;
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
}
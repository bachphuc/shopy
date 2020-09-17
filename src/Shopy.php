<?php

namespace bachphuc\Shopy;

use bachphuc\Shopy\Version;
use bachphuc\Shopy\Models\Cart;

class Shopy
{
    protected $version = null;
    protected $customLayout = null;
    protected $layout = 'default';
    protected $theme = 'default';

    protected $_cart = null;

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

    public function setLayout($layout)
    {
        $this->customLayout = $layout;
    }

    public function layout()
    {
        if(!empty($this->customLayout)) return $this->customLayout;
        return 'bachphuc.shopy::templates.' . $this->theme . '.layouts.' . $this->layout;
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
}
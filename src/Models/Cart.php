<?php

namespace bachphuc\Shopy\Models;

use bachphuc\Shopy\Models\CartItem;

class Cart extends ProductBase
{
    protected $table = 'shopy_carts';
    protected $itemType = 'shopy_cart';

    protected $_images = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount', 'count', 'currency', 
    ];

    public function user(){
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function addProduct($product, $params = []){
        $count = isset($params['count']) ? $params['count'] : 1;
        $price = $product->getPrice();

        $item = CartItem::where('cart_id', $this->id)
        ->where('product_id', $product->id)
        ->first();

        if($item){
            $item->count+= $count;
            $item->updateAmount();
        }
        else{
            $item = CartItem::create([
                'user_id' => user_id(),
                'product_id' => $product->id,
                'price' => $price,
                'count' => $count,
                'amount' => $price * $count,
                'cart_id' => $this->id
            ]);
        }

        $this->updateStats();

        return $item;
    }

    public function removeProduct($product){
        CartItem::where('cart_id', $this->id)
        ->where('product_id', $product->id)
        ->delete();

        $this->updateStats();
    }

    public function items(){
        $items = CartItem::with(['product'])
        ->where('cart_id', $this->id)
        ->get();

        return $items;
    }

    public function updateStats(){
        $this->amount = CartItem::where('cart_id', $this->id)
        ->sum('amount');

        $this->count = CartItem::where('cart_id', $this->id)
        ->sum('count');
        $this->save();
    }
}
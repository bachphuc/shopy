<?php

namespace bachphuc\Shopy\Models;

use bachphuc\LaravelGalleryImage\Models\GalleryImage;

class CartItem extends ProductBase
{
    protected $table = 'shopy_cart_items';
    protected $itemType = 'shopy_cart_item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'cart_id', 'product_id', 'price', 'count', 'amount', 'currency', 'variant_id',
    ];

    public function user(){
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function product(){
        return $this->belongsTo('bachphuc\Shopy\Models\Product', 'product_id');
    }

    public function variant(){
        return $this->belongsTo('bachphuc\Shopy\Models\ProductVariant', 'variant_id');
    }

    public function updateAmount(){
        $this->amount = $this->price * $this->count;
        $this->save();
    }

    public function displayAmount(){
        return number_format($this->amount, 0, ',', '.') . ' VNĐ';
    }

    public function displayPrice(){
        return number_format((int) $this->price, 0, ",", '.') . ' VNĐ';
    }
}
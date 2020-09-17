<?php

namespace bachphuc\Shopy\Models;

use bachphuc\LaravelGalleryImage\Models\GalleryImage;

class OrderItem extends ProductBase
{
    protected $table = 'shopy_order_items';
    protected $itemType = 'shopy_order_item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'order_id', 'product_id', 'price', 'count', 'amount', 'currency',
    ];

    public function user(){
        return $this->belongsTo('\App\User', 'user_id');
    }
}
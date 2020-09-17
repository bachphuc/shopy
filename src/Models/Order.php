<?php

namespace bachphuc\Shopy\Models;

use bachphuc\LaravelGalleryImage\Models\GalleryImage;

class Order extends ProductBase
{
    protected $table = 'shopy_orders';
    protected $itemType = 'shopy_order';

    protected $_images = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount', 'count', 'currency', 'status', 'payment_method', 'delivery_status',
    ];

    public function user(){
        return $this->belongsTo('\App\User', 'user_id');
    }
}
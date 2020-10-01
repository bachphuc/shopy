<?php

namespace bachphuc\Shopy\Models;

use bachphuc\LaravelGalleryImage\Models\GalleryImage;

class Promotion extends ProductBase
{
    protected $table = 'shopy_promotions';
    protected $itemType = 'shopy_promotion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'promotion_type', 'discount_type', 'discount_amount', 'item_type', 'item_id', 
    ];

    // promotion_type:coupon
    // discount_type:percent|amount
}
<?php

namespace bachphuc\Shopy\Models;

class Product extends ProductBase
{
    protected $table = 'shopy_products';
    protected $itemType = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'image', 'description', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('\App\User', 'user_id');
    }
}
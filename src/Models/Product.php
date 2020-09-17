<?php

namespace bachphuc\Shopy\Models;

use bachphuc\LaravelGalleryImage\Models\GalleryImage;

class Product extends ProductBase
{
    protected $table = 'shopy_products';
    protected $itemType = 'shopy_product';

    protected $_images = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'image', 'description', 'user_id', 'price', 'count', 'alias', 'category_id', 'currency'
    ];

    public function user(){
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function getHref(){
        return route('products.show', ['product' => $this]);
    }

    public function getImages(){
        if($this->_images !== null) return $this->_images;
        $this->_images = GalleryImage::getImagesOf($this);
        return $this->_images;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getRelated(){
        $products = Product::limit(4)
        ->get();

        return $products;
    }
}
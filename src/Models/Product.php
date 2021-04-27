<?php

namespace bachphuc\Shopy\Models;

use bachphuc\LaravelGalleryImage\Models\GalleryImage;

use bachphuc\Shopy\Models\ProductVariant;

use Shopy;

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
        'title', 'image', 'description', 'user_id', 'price', 'count', 'alias', 'category_id', 'currency', 'alias', 'is_hot', 'is_new', 'is_featured', 'total_variants', 'total_sold', 'total_view', 'total_click'
    ];

    public function user(){
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function category(){
        return $this->belongsTo('\bachphuc\Shopy\Models\Category', 'category_id');
    }

    public function getHref(){
        if(empty($this->alias)){
            // update alias
            $this->alias = str_slug($this->title) . '-' . $this->id;
            $this->save();
        }

        return Shopy::route('products.detail', ['alias' => $this->alias]);
    }

    public static function findByName($alias){
        if(empty($alias)) return null;
        return Product::where('id', $alias)
        ->orWhere('alias', $alias)
        ->orWhere('title', $alias)
        ->first();
    }

    public function getImages(){
        if($this->_images !== null) return $this->_images;
        $imgs = GalleryImage::getImagesOf($this);

        if($imgs->count()){
            $this->_images = $imgs;
        }
        else{
            $this->_images = [$this];
        }
        return $this->_images;
    }

    public function getPrice(){
        return $this->price;
    }

    public function displayPrice(){
        return number_format((int) $this->price, 0, ",", '.') . ' VNĐ';
    }

    public function getRelated(){
        $products = Product::limit(4)
        ->get();

        return $products;
    }

    public function getVariants(){
        return ProductVariant::where('product_id', $this->id)
        ->get();
    }

    public function getPriceOf($variant = null){
        if($variant){
            return $variant->getPrice();
        }
        return $this->getPrice();
    }

    public function updateTotalVariants(){
        $this->total_variants = ProductVariant::where('product_id', $this->id)
        ->count();
        
        $this->save();
    }

    public function getAdminHref(){
        return Shopy::adminRoute('products.show', ['product' => $this]);
    }
}
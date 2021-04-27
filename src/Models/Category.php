<?php

namespace bachphuc\Shopy\Models;

use bachphuc\Shopy\Models\Cart;
use bachphuc\Shopy\Models\OrderItem;
use bachphuc\Shopy\Models\Product;
use bachphuc\Shopy\Facades\ShopyFacade as Shopy;

class Category extends ProductBase
{
    protected $table = 'shopy_categories';
    protected $itemType = 'shopy_category';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'alias', 'description', 'image', 'thumbnail_120', 'thumbnail_300', 'thumbnail_500', 'thumbnail_720', 'parent_category_id', 'gender', 'total_product',
    ];

    public function category(){
        return $this->belongsTo('\bachphuc\Shopy\Models\Category', 'parent_category_id');
    }

    public function getHref(){
        return Shopy::route('categories.show', ['alias' => !empty($this->alias) ? $this->alias : $this->id]);
    }

    public function products(){
        return Product::where('category_id', $this->id)
        ->get();
    }

    public static function findByName($alias){
        return Category::where('id', $alias)
        ->orwhere('alias', $alias)
        ->orWhere('title', $alias)
        ->first();
    }

    public function updateTotalProducts(){
        $this->total_product = Product::where('category_id', $this->id)
        ->count();
        $this->save();
    }

    public function getAdminHref(){
        return Shopy::adminRoute('categories.show', ['id' => $this->id]);
    }

    public function getChildren(){
        return Category::where('parent_category_id', $this->id)
        ->get();
    }
}
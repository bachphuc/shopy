<?php

namespace bachphuc\Shopy\Models;

use bachphuc\LaravelGalleryImage\Models\GalleryImage;

class ProductVariant extends ProductBase
{
    protected $table = 'shopy_product_variants';
    protected $itemType = 'shopy_product_variant';

    protected $_extractFields = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'price', 'count', 'image', 'is_sold_out', 'is_disabled', 'total_sold', 'fields', 'values', 'search_values', 'search_fields', 'search', 'sku',
    ];

    public function user(){
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function product(){
        return $this->belongsTo('\bachphuc\Shopy\Models\Product', 'product_id');
    }

    public function initFields(){
        if($this->_extractFields !== null) return;

        $results = [];

        if(!empty($this->search)){
            $tmp = explode(',', $this->search);
            foreach($tmp as $t){
                $s = str_replace('[', '', $t);
                $s = str_replace(']', '', $s);
                $tmp2 = explode('|', $s);
                $results[$tmp2[0]] = $tmp2[1];
            }
        }

        $this->_extractFields = $results;
    }

    public function getField($field, $params = []){
        if($this->hasField($field)) return parent::getField($field, $params);

        $this->initFields();

        if(isset($this->_extractFields[$field])){
            return $this->_extractFields[$field];
        }

        return null;
    }

    public function hasOption($field, $option){
        $value = $this->getField($field);
        return $value == $option ? true : false;
    }

    public function getPrice(){
        return $this->price;
    }

    public function toArray(){
        $this->initFields();
        $results = parent::toArray();
        return array_merge($results, $this->_extractFields);
    }

    public function fields(){
        $this->initFields();
        return $this->_extractFields;
    }
}
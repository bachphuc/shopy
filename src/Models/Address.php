<?php

namespace bachphuc\Shopy\Models;

use bachphuc\LaravelGalleryImage\Models\GalleryImage;

class Address extends ProductBase
{
    protected $table = 'shopy_addresses';
    protected $itemType = 'shopy_address';

    protected static $_addresses = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'phone', 'province', 'district', 'ward', 'address',
    ];

    public function user(){
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function getTitle(){
        return $this->address;
    }

    public static function getUserAddresses(){
        if(self::$_addresses !== null) return self::$_addresses;
        self::$_addresses = Address::where('user_id', user_id())
        ->get();

        return self::$_addresses;
    }

    public static function createAddress($data = []){
        $insert = array_extract($data, [
            'first_name', 'last_name', 'phone', 'province', 'district', 'ward', 'address'
        ], [
            'user_id' => user_id()
        ]);
        $address = Address::create($insert);

        return $address;
    }

    public function getFullText(){
        return $this->address . ', ' . $this->district . ', ' . $this->province;
    }

    public static function getAddressesOf($user = null){
        if(!$user) return [];

        return Address::where('user_id', $user->id)
        ->get();
    }
}
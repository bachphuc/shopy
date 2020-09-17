<?php

namespace bachphuc\Shopy\Facades;

use Illuminate\Support\Facades\Facade;

class ShopyFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'shopy'; }

    /**
     * Register the routers for shopy.
     *
     * @return void
     */
    public static function routes()
    {
        self::productRoutes();
        self::homeRoutes();
    }

    /**
     * Register the routers for shopy.
     *
     * @return void
     */
    public static function productRoutes()
    {
        $router = static::$app->make('router');

        $namespace = '\bachphuc\Shopy\Http\Controllers\\';

        $router->resource('products', $namespace . 'ProductController');

        $router->resource('carts', $namespace. 'CartController');
        $router->get('cart/checkout', $namespace. 'CartController@checkout')->name('carts.checkout');
        $router->post('cart/checkout/payment-method', $namespace. 'CartController@paymentMethod')->name('carts.payment-method');
        $router->post('cart/place-order', $namespace. 'CartController@placeOrder')->name('carts.place-order');
    }

    /**
     * Register the routers for shopy.
     *
     * @return void
     */
    public static function adminRoutes()
    {
        $router = static::$app->make('router');

        $router->group(['prefix' => 'admin', 'as' => 'admin.'], function() use($router) {
            $router->resource('products', '\bachphuc\Shopy\Http\Controllers\Admin\ManageProductController');
            $router->post('upload-product-image', '\bachphuc\Shopy\Http\Controllers\Admin\ManageProductController@uploadProductImage')->name('upload-item-image');
            $router->delete('delete-product-image', '\bachphuc\Shopy\Http\Controllers\Admin\ManageProductController@uploadProductImage')->name('delete-item-image');
        });
    }

    /**
     * Register the routers for shopy.
     *
     * @return void
     */
    public static function homeRoutes()
    {
        $router = static::$app->make('router');

        $router->get('/', '\bachphuc\Shopy\Http\Controllers\IndexController@index')->name('shopy.home');
    }
}
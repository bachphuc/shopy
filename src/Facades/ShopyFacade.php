<?php

namespace bachphuc\Shopy\Facades;

use Illuminate\Support\Facades\Facade;

use CustomField;
use AppSetting;

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
        self::accountRoutes();
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
        $router->get('product/{alias}', $namespace. 'ProductController@detail')->name('products.detail');

        $router->resource('carts', $namespace. 'CartController');
        $router->get('cart/checkout', $namespace. 'CartController@checkout')->name('carts.checkout');
        $router->post('cart/checkout/payment-method', $namespace. 'CartController@paymentMethod')->name('carts.payment-method');
        $router->post('cart/place-order', $namespace. 'CartController@placeOrder')->name('carts.place-order');

        $router->get('categories/{alias}', $namespace. 'CategoryController@show')->name('categories.show');
    }

    /**
     * Register the account routers for shopy.
     *
     * @return void
     */
    public static function accountRoutes()
    {
        $router = static::$app->make('router');

        $namespace = '\bachphuc\Shopy\Http\Controllers\\';

        $router->get('account/orders', $namespace. 'AccountController@orders')->name('account.orders');
        $router->get('account/orders/{order}', $namespace. 'AccountController@orderDetail')->name('orders.show');
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
            $namespace = '\bachphuc\Shopy\Http\Controllers\Admin\\';
            $router->get('/', $namespace. 'AdminController@index')->name('index');

            $router->resource('products', $namespace. 'ManageProductController');
            $router->post('upload-product-image', $namespace .'ManageProductController@uploadProductImage')->name('upload-item-image');
            $router->delete('delete-product-image', $namespace .'ManageProductController@uploadProductImage')->name('delete-item-image');

            $router->resource('categories', $namespace . 'ManageCategoryController');

            $router->resource('fields', $namespace . 'ProductFieldsController');

            $router->resource('products.variants', $namespace. 'ManageVariantController');

            $router->resource('orders', $namespace . 'ManageOrderController');
            $router->post('orders/{order}/confirm', $namespace . 'ManageOrderController@confirmOrder')->name('orders.confirm');
            $router->post('orders/{order}/confirm-delivery', $namespace . 'ManageOrderController@confirmOrderDeliveried')->name('orders.confirm-delivery');
            $router->post('orders/{order}/start-delivery', $namespace . 'ManageOrderController@startDelivery')->name('orders.start-delivery');
            
            $router->resource('customers', $namespace . 'ManageCustomerController');

            $router->get('setup', $namespace. 'SetupController@index')->name('setup');
            $router->post('setup', $namespace. 'SetupController@store')->name('setup.store');

            AppSetting::routes([
                'namespace' => $namespace,
                'controller' => 'SettingController'
            ]);
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
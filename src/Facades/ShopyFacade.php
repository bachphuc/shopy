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
        $router = static::$app->make('router');

        $router->resource('products', '\bachphuc\Shopy\Http\Controllers\ProductController');
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
        });
    }
}
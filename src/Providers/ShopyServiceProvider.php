<?php

namespace bachphuc\Shopy\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

use bachphuc\Shopy\Version;

use LaravelTheme;

class ShopyServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'bachphuc\Shopy\Http\Controllers';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $packagePath = dirname(__DIR__);

        // register view
        $this->loadViewsFrom($packagePath . '/resources/views', 'shopy');

        $this->loadMigrationsFrom($packagePath.'/database/migrations');

        // boot translator
        $this->loadTranslationsFrom($packagePath . '/resources/lang' , 'shopy');

        $this->mergeConfigFrom(
            $packagePath . '/config/shopy.php', 'shopy'
        );

        $this->publishes([
            $packagePath .'/config/shopy.php' => config_path('shopy.php'),
        ], 'shopy-config');

        $this->publishes([
            $packagePath . '/public/assets' => public_path('vendor/shopy/assets'),
        ], 'shopy-assets');

        \HtmlElement::mapNamespace('shopy', '\bachphuc\Shopy');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Register the service provider for the dependency.
         */

        $this->mapRoutes();

        $this->app->bind('shopy', function(){
            return new \bachphuc\Shopy\Shopy(new Version());
        });

        $this->app->bind('shopy_product', '\bachphuc\Shopy\Models\Product');
        $this->app->bind('shopy_category', '\bachphuc\Shopy\Models\Category');
        $this->app->bind('shopy_product_variant', '\bachphuc\Shopy\Models\ProductVariant');

        LaravelTheme::registerFacade('shopy');
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function mapRoutes()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        $packagePath = dirname(__DIR__);
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group($packagePath. '/routes/web.php');
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $packagePath = dirname(__DIR__);
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group($packagePath . '/routes/api.php');
    }
}
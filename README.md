# SHOPY PACKAGE FOR LARAVEL

## Guide
1. Step 1
Add ShopyServiceProvider to "providers" in app.php.

``bachphuc\Shopy\Providers\ShopyServiceProvider::class,``

2. Step 2
Add ShopyFacade to "alias" in app.php

``'Shopy' => bachphuc\Shopy\Facades\ShopyFacade::class,``

3. Add shopy routes into web.php

``Shopy::routes();``
``Shopy::adminRoutes();``
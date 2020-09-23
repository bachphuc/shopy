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

5. Custom fields package: dsoft_custom_fields

## dsoft_fields
- name, field_type: text|select|multi_select

## dsoft_field_items
- item_type, item_id, field_id

## components
- form: CustomField: apply to form
- fields_list: to display like table

6. Product variants
- depend on package custom fields
- choose fields/custom field

6. Rating/comment package dsoft_feedback
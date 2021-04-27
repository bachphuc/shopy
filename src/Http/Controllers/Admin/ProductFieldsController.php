<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

use Illuminate\Http\Request;
use bachphuc\Shopy\Facades\ShopyFacade as Shopy;

use bachphuc\LaravelHTMLElements\Components\Form;
use bachphuc\LaravelCustomFields\Http\Controllers\FieldsController;

use CustomField;

class ProductFieldsController extends FieldsController
{
    protected $layout = 'shopy::admin.default.layouts.default';
    protected $objectType = 'shopy_product';
}
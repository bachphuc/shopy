<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

use Illuminate\Http\Request;
use bachphuc\LaravelSettings\Http\Controllers\SettingController as SettingBaseController;

class SettingController extends SettingBaseController
{
    protected $theme = 'bootstrap';
    protected $layout = 'bachphuc.shopy::admin.default.layouts.default';
    protected $prefixName = 'admin.';
}
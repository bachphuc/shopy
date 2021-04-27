<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

use Illuminate\Http\Request;
use bachphuc\LaravelSettings\Http\Controllers\SettingController as SettingBaseController;

use Shopy;

class SettingController extends SettingBaseController
{
    protected $theme = 'bootstrap';
    protected $prefixName = 'admin.';

    public function getMenus(){
        $this->menus = Shopy::getAdminMenus();

        return $this->menus;
    }
}
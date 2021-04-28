<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

use bachphuc\LaravelHTMLElements\Http\Controllers\ManageBaseController as BaseController;

use bachphuc\Shopy\Facades\ShopyFacade as Shopy;
use LaravelTheme;

class ManageBaseController extends BaseController{
    protected $colorTheme = 'white';

    public function getMenus(){
        $this->menus = LaravelTheme::getAdminMenus();

        return $this->menus;
    }
}
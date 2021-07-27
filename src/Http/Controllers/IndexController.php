<?php

namespace bachphuc\Shopy\Http\Controllers;

use Shopy;

class IndexController extends Controller
{
    public function index()
    {
        theme_active_menu('home');
        return Shopy::view('index');
    }
}
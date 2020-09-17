<?php

namespace bachphuc\Shopy\Http\Controllers;

use Shopy;

class IndexController extends Controller
{
    public function index()
    {
        return Shopy::view('index');
    }
}
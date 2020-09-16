<?php

namespace bachphuc\Shopy\Http\Controllers;

class IndexController extends Controller
{
    public function index()
    {
        return view('bachphuc.shopy::index');
    }
}
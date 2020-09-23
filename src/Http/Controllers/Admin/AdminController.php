<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

use Illuminate\Http\Request;
use bachphuc\Shopy\Facades\ShopyFacade as Shopy;

class AdminController extends Controller
{
    public function index(Request $request){
        return Shopy::adminView('index', []);
    }
}
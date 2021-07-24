<?php

namespace bachphuc\Shopy\Http\Controllers;

use Illuminate\Http\Request;

use bachphuc\Shopy\Facades\ShopyFacade as Shopy;
use bachphuc\Shopy\Models\Product;
use bachphuc\Shopy\Models\Address;
use bachphuc\Shopy\Models\Order;

class AccountController extends Controller
{
    public function orders(Request $request){

        return Shopy::view('account.orders', [
            'orders' => Order::myOrders()
        ]);
    }

    public function orderDetail(Request $request, Order $order){
        return Shopy::view('account.order-detail', [
            'order' => $order,
            'steps' => $order->getSteps()
        ]); 
    }

    public function logout(Request $request){
        auth()->logout();

        return redirect()->to('/');
    }
}
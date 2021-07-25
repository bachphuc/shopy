<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

use Illuminate\Http\Request;
use bachphuc\Shopy\Facades\ShopyFacade as Shopy;
use bachphuc\Shopy\Models\Product;
use bachphuc\Shopy\Models\Order;
use bachphuc\LaravelHTMLElements\Components\Table;

use App\User;
use LaravelTheme;

class AdminController extends Controller
{
    public function index(Request $request){
        $totalCustomers = User::count();
        $totalOrders = Order::count();
        $totalProducts = Product::count();

        $newOrders = Order::orderBy('created_at', 'DESC')
        ->take(12)
        ->get();

        $newOrdersTable = Table::create([
            'theme' => $this->theme,
            'items' => $newOrders,
            'fields' => [
                'id' => [
                    'type' => 'admin_link'
                ],
                'amount',
                'created_at',
                'status' => [
                    'label' => [
                        'pending' => 'warning',
                        'success' => 'success',
                        'shipping_confirm' => 'danger',
                        'admin_confirmed' => 'info',
                        'cancelled' => 'danger',
                    ]
                ]
            ]
        ]);

        $totalEarn = (int) Order::where('status', Order::SUCCESS)
        ->sum('amount');

        return Shopy::adminView('index', [
            'totalCustomers' => $totalCustomers,
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'newOrdersTable' => $newOrdersTable,
            'totalEarn' => $totalEarn,
            'menus' => LaravelTheme::getAdminMenus(),
            'colorTheme' => $this->colorTheme,
        ]);
    }
}
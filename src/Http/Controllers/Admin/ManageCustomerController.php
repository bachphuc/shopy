<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

use bachphuc\Shopy\Models\Order;
use bachphuc\Shopy\Facades\ShopyFacade as Shopy;
use bachphuc\LaravelHTMLElements\Components\Table;
use App\User;

class ManageCustomerController extends ManageBaseController{
    protected $modelName = 'user';
    protected $model = '\App\User';
    protected $activeMenu = 'customers';
    protected $searchFields = ['id'];
    protected $modelRouteName = 'admin.customers';
    // protected $authMiddleware = 'auth';

    protected $itemDisplayField = 'name';

    protected $isShowCreateButton = false;

    public function processTable(&$table){

    }

    public function createFormElements($isUpdate = false){
        return [
            'name' => [
                'validator' => 'required'
            ],
            'email',
        ];
    }

    public function createTableFields(){
        return [
            'id',
            'name' => [
                'render' => function($item){
                    return '<a class="fast-link" href="'. Shopy::adminRoute('customers.show', ['id' => $item->id]) . '">' . $item->name . '</a>';
                }
            ],
            'email',
        ];
    }

    public function show($id){
        $user = User::findOrFail($id);

        $orders = Order::where('user_id', $user->id)
        ->orderBy('created_at', 'DESC')
        ->get();

        $orderTable = Table::create([
            'theme' => $this->getTheme(),
            'items' => $orders,
            'fields' => [
                'id' => [
                    'render' => function($item){
                        return '<a href="' . $item->getAdminHref() . '">#' . $item->id . '</a>';
                    }
                ],
                'amount' => [
                    'type' => 'int'
                ],
                'created_at',
                'status' => [
                    'label' => [
                        'pending' => 'danger',
                        'success' => 'success',
                        'admin_confirmed' => 'info',
                        'shipping_confirm' => 'danger',
                    ]
                ]
            ]
        ]);
        
        return Shopy::adminView('customers.show', [
            'activeMenu' => $this->activeMenu,
            'user' => $user,
            'orderTable' => $orderTable,
            'menus' => $this->getMenus(),
            'colorTheme' => $this->getColorTheme(),
        ]);
    }
}
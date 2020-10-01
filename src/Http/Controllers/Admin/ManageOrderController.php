<?php

namespace bachphuc\Shopy\Http\Controllers\Admin;

use bachphuc\Shopy\Models\Order;
use bachphuc\Shopy\Facades\ShopyFacade as Shopy;
use bachphuc\LaravelHTMLElements\Components\Table;

use Illuminate\Http\Request;
use Session;

class ManageOrderController extends ManageBaseController{
    protected $modelName = 'order';
    protected $model = '\bachphuc\Shopy\Models\Order';
    protected $activeMenu = 'orders';
    protected $searchFields = ['id'];
    protected $modelRouteName = 'admin.orders';
    // protected $authMiddleware = 'auth';

    protected $itemDisplayField = 'title';

    protected $isShowCreateButton = false;

    public function processTable(&$table){
        $table->setAttribute('filters', [
            'fields' => [
                [
                    'title' => 'Status',
                    'name' => 'status',
                    'type' => 'select',
                    'options' => Order::STATUSES
                ]
            ]
        ]);
    }

    public function createFormElements($isUpdate = false){
        return [
            'amount',
            'status'
        ];
    }

    public function createTableFields(){
        return [
            'id' => [
                'render' => function($item){
                    return '<a href="'. $item->getAdminHref() .'">#'. $item->id .'</a>';
                }
            ],
            'user' => [
                'render' => function($item){
                    if(!$item->user) return;
                    $html = '<p><a href="' . route('admin.customers.edit', ['user' => $item->user]) . '">' . $item->user->name. '</a></p>';
                    if($item->address){
                        $html.= '<p><span class="text-primary">' . $item->address->phone . '</span> <br><span class="">' . $item->address->getFullText() . '</span></p>';
                    }
                    
                    return $html;
                }
            ],
            'created_at',
            'amount',
            'payment_method' => [
                'uppercase' => true
            ],
            'payment_status',
            'delivery_status' => [
                'label' => [
                    'pending' => 'warning',
                    'finished' => 'success',
                    'in_progress' => 'info',
                ]
            ],
            'status' => [
                'label' => [
                    'pending' => 'warning',
                    'shipping_confirm' => 'danger',
                    'success' => 'success',
                    'admin_confirmed' => 'info',
                ]
            ],
        ];
    }

    public function processQuery(Request $request, &$query){
        if($request->query('status') && !empty($request->query('status'))){
            $query->where('status', $request->query('status'));
            $this->addQueryParams('status', $request->query('status'));
        }
        else{
            $query->where('status', '<>', Order::SHIPPING_CONFIRM);
        }
    }

    public function show($id){
        $order = Order::findOrFail($id);

        $productTable = Table::create([
            'items' => $order->items(),
            'theme' => $this->getTheme(),
            'fields' => [
                'id',
                'image' => [
                    'render' => function($item){
                        return '<img class="w50" src="'. $item->product->getImage() .'" />';
                    }
                ],
                'title' => [
                    'render' => function($item){
                        $html = '<p><a href="'. $item->product->getAdminHref() .'">' . $item->product->title . '</a></p>';
                        if($item->variant){
                            $variantFields = $item->variant->fields();
                            $fieldEles = [];
                            foreach($variantFields as $key => $value){
                                $fieldEles[] = '<label class="label label-info">' . ucfirst($key) . ' / ' . $value . ' </label> ';
                            }
                            if(!empty($fieldEles)){
                                $html.= '<p>' . implode('', $fieldEles) . '</p>';
                            }
                        }
                        return $html;
                    }
                ],
                'price',
                'count',
                'amount',
            ]
        ]);

        $orderTable = Table::create([
            'theme' => $this->getTheme(),
            'items' => [$order],
            'fields' => [
                'id',
                'created_at',
                'amount',
                'delivery_status',
                'status' => [
                    'label' => [
                        'pending' => 'danger',
                        'admin_confirmed' => 'info',
                        'success' => 'success'
                    ]
                ],
                'payment_method' => [
                    'uppercase' => true
                ],
            ]
        ]);

        $steps = $order->getSteps();

        return Shopy::adminView('orders.show', [
            'activeMenu' => $this->activeMenu,
            'order' => $order,
            'orderTable' => $orderTable,
            'productTable' => $productTable,
            'steps' => $steps
        ]);
    }

    public function confirmOrder(Request $request, Order $order){
        $order->markAdminConfirm();

        Session::flash('message', trans('shopy::lang.confirmed_order_success'));
        return redirect()->to(Shopy::adminRoute('orders.show', ['order' => $order]));
    }

    public function confirmOrderDeliveried(Request $request, Order $order){
        $order->markConfirmDeliveried();

        Session::flash('message', trans('shopy::lang.confirm_deliveried_order_success'));
        return redirect()->to(Shopy::adminRoute('orders.show', ['order' => $order]));
    }

    public function startDelivery(Request $request, Order $order){
        $order->startDelivery();

        Session::flash('message', trans('shopy::lang.started_delivery'));
        return redirect()->to(Shopy::adminRoute('orders.show', ['order' => $order]));
    }
}
<?php

namespace bachphuc\Shopy\Models;

use bachphuc\Shopy\Models\Cart;
use bachphuc\Shopy\Models\OrderItem;
use bachphuc\Shopy\Facades\ShopyFacade as Shopy;

class Order extends ProductBase
{
    protected $table = 'shopy_orders';
    protected $itemType = 'shopy_order';

    protected $_images = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount', 'count', 'currency', 'status', 'payment_method', 'delivery_status', 'note', 'shipping_id', 'delivery_estimate_at', 'deliveried_at', 'failure_reason', 'payment_status', 'shipping_fee',
    ];

    const SHIPPING_CONFIRM = 'shipping_confirm';
    const PENDING = 'pending';
    const SUCCESS = 'success';
    const CANCELLED = 'cancelled';
    const ADMIN_CONFIRMED = 'admin_confirmed';

    const STATUSES = [
        Order::SHIPPING_CONFIRM, Order::PENDING, Order::ADMIN_CONFIRMED, Order::SUCCESS, Order::CANCELLED
    ];

    const DELIVERY_PENDING = 'pending';
    const DELIVERY_IN_PROGRESS = 'in_progress';
    const DELIVERY_FINISHED = 'finished';

    const PAYMENT_PENDING = 'pending';
    const PAYMENT_SUCCESS = 'success';
    const PAYMENT_FAILED = 'failed';

    // status: [checkout] -> shipping_confirm -> [payment] -> pending -> admin_confirmed -> cancelled|success|admin_cancelled
    // delivery_status:pending|in_progress|success|failed

    public function user(){
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function address(){
        return $this->belongsTo('\bachphuc\Shopy\Models\Address', 'shipping_id');
    }

    public static function createFromCart($params = []){
        $cart = Shopy::cart();
        $items = $cart->items();

        if(!$items->count()){
            return null;
        }

        $order = Order::create([
            'user_id' => user_id(),
            'amount' => $cart->amount,
            'count' => $cart->count,
            'currency' => $cart->currency,
            'status' => Order::SHIPPING_CONFIRM,
            'shipping_id' => isset($params['shipping_id']) ? $params['shipping_id'] : 0,
        ]);

        foreach($items as $item){
            $orderItem = OrderItem::create([
                'user_id' => user_id(),
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'price' => $item->price,
                'count' => $item->count,
                'amount' => $item->amount,
                'currency' => $item->currency,
                'variant_id' => $item->variant_id,
            ]);
        }

        $cart->clear();

        return $order;
    }

    public function placeOrderWithCOD(){
        $this->status = Order::PENDING;
        $this->payment_method = 'cod';
        $this->delivery_status = Order::DELIVERY_PENDING;
        $this->save();

        $this->sendEmailPlaceSuccess();
    }

    public function sendEmailPlaceSuccess(){

    }

    public static function myOrders(){
        return Order::where('user_id', user_id())
        ->orderBy('created_at', 'DESC')
        ->get();
    }

    public function getHref(){
        return Shopy::route('orders.show', ['order' => $this]);
    }

    public function items(){
        return OrderItem::with(['product'])->where('order_id', $this->id)
        ->get();
    }

    public function getAdminHref(){
        return Shopy::route('admin.orders.show', ['show' => $this]);
    }

    public function markAdminConfirm(){
        $this->status = Order::ADMIN_CONFIRMED;
        $this->save();

        // TODO: send email about this order is confirmed to user
    }

    public function isAdminConfirm(){
        return $this->status == Order::ADMIN_CONFIRMED ? true : false;
    }

    public function isSuccess(){
        return $this->status == Order::SUCCESS ? true : false;
    }

    public function markConfirmDeliveried(){
        $this->status = Order::SUCCESS;
        $this->delivery_status = Order::DELIVERY_FINISHED;
        $this->deliveried_at = now()->toDateTimeString();
        $this->save();

        // TODO: send email thank you to user and include link to rating review
    }

    public function isDeliveryPending(){
        if(empty($this->delivery_status)) return true;
        return $this->delivery_status == Order::DELIVERY_PENDING ? true : false;
    }

    public function isDeliveryInProgress(){
        return $this->delivery_status == Order::DELIVERY_IN_PROGRESS ? true : false;
    }

    public function startDelivery(){
        $this->delivery_status = Order::DELIVERY_IN_PROGRESS;
        $this->save();

        // TODO: send email to customer about their order is delivering.
    }

    public function getSteps(){
        $steps = [
            'order' => [
                'title' => 'Ordered',
            ], 
            'confirm' => [
                'title' => 'Confirm',
            ], 
            'delivery' => [
                'title' => 'Delivery'
            ], 
            'payment' => [
                'title'=> 'Payment'
            ],
            'finish' => [
                'title' => 'Finish'
            ]
        ];

        if(!$this->isSuccess()){
            if(!$this->isAdminConfirm()){
                $steps['order']['active'] = true;
            }
            else{
                $steps['confirm']['title'] = 'Confirmed';
                if($this->isDeliveryInProgress()){
                    $steps['delivery']['title'] = 'Delivering';
                    $steps['delivery']['active'] = true;
                    $steps['delivery']['processing'] = true;
                }
                else{
                    $steps['confirm']['active'] = true;
                }
            }
        }
        else{
            $steps['finish']['title'] = 'Finished';
        }

        return $steps;
    }
}
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
        'user_id', 'amount', 'count', 'currency', 'status', 'payment_method', 'delivery_status', 'note', 'shipping_id', 
    ];

    const SHIPPING_CONFIRM = 'shipping_confirm';
    const PENDING = 'pending';
    const SUCCESS = 'success';
    const CANCELLED = 'cancelled';

    const DELIVERY_PENDING = 'pending';
    const DELIVERY_IN_PROGRESS = 'in_progress';
    const DELIVERY_FINISHED = 'finished';

    // status: [checkout] -> shipping_confirm -> [payment] -> pending -> [delivery] -> success | [cancel] -> cancelled

    public function user(){
        return $this->belongsTo('\App\User', 'user_id');
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
            'status' => Order::SHIPPING_CONFIRM
        ]);

        foreach($items as $item){
            $orderItem = OrderItem::create([
                'user_id' => user_id(),
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'price' => $item->price,
                'count' => $item->count,
                'amount' => $item->amount,
                'currency' => $item->currency
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
        return route('orders.show', ['order' => $this]);
    }

    public function items(){
        return OrderItem::with(['product'])->where('order_id', $this->id)
        ->get();
    }
}
<?php

namespace bachphuc\Shopy\Http\Controllers;

use Illuminate\Http\Request;

use bachphuc\Shopy\Facades\ShopyFacade as Shopy;
use bachphuc\Shopy\Models\Product;
use bachphuc\Shopy\Models\Address;
use bachphuc\Shopy\Models\Order;

use Session;

class CartController extends Controller
{
    public function index(){
        return Shopy::view('carts.index', []);
    }

    public function store(Request $request){
        $request->validate([
            'product_id' => 'required'
        ]);

        $data = $request->all();

        $product = Product::find($data['product_id']);
        if(!$product){
            abort(404);
        }

        Shopy::cart()->addProduct($product, $data);

        if($request->ajax()){
            $content = Shopy::view('components.mini-cart', [
                'full' => false,
                'newProductId' => $product->id
            ])->render();

            return [
                'status' => true,
                'content' => $content,
                'cart' => [
                    'total' => Shopy::cartTotal()
                ]
            ];
        }

        return redirect()->to($product->getHref() . '?show_cart=1');
    }

    public function destroy(Request $request, $id){
        $product = Product::find($id);
        if(!$product){
            abort(404);
        }

        Shopy::cart()->removeProduct($product);

        return redirect()->route('carts.index');
    }

    public function checkout(Request $request){
        if(!Shopy::cartTotal() ){
            return redirect()->route('carts.index');
        }
        return Shopy::view('carts.checkout', []);
    }

    public function paymentMethod(Request $request){
        // create new or update payment
        $data = $request->all();
        if($data['address_type'] === 'create_new'){
            $addressData = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'province' => 'required',
                'district' => 'required',
                'ward' => 'required',
                'address' => 'required',
            ]);

            $address = Address::createAddress($addressData);
        }
        else{
            $address = Address::find($data['address_id']);
        }

        return Shopy::view('carts.payment-method', [
            'address' => $address
        ]);
    }

    public function placeOrder(Request $request){
        $request->validate([
            'payment_method' => 'required',
            'address_id' => 'required',
        ]);

        $address = Address::find($request->input('address_id'));

        $params = [
            'shipping_id' => $address->id
        ];

        if(isset($data['note'])){
            $params['note'] = $data['note'];
        }
        
        $order = Order::createFromCart($params);

        $data = $request->all();

        if($data['payment_method'] === 'cod'){
            $order->placeOrderWithCOD();
        }
        else{
            // handle payment gateway here
        }

        Session::flash('message', trans('shopy::message.place_order_successfull'));

        return redirect()->to('');
    }
}
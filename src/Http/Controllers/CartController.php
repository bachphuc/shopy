<?php

namespace bachphuc\Shopy\Http\Controllers;

use Illuminate\Http\Request;

use bachphuc\Shopy\Facades\ShopyFacade as Shopy;
use bachphuc\Shopy\Models\Product;
use bachphuc\Shopy\Models\Address;
use bachphuc\Shopy\Models\Order;

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

        return redirect()->to($product->getHref());
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

        $params = [
            'shipping_id' => $address->id
        ];

        if(isset($data['note'])){
            $params['note'] = $data['note'];
        }
        
        $order = Order::createFromCart($params);

        return Shopy::view('carts.payment-method', [
            'order' => $order
        ]);
    }

    public function placeOrder(Request $request){
        $request->validate([
            'payment_method' => 'required',
            'order_id' => 'required'
        ]);

        $order = Order::find($request->input('order_id'));
        if(!$order){
            abort(404);
        }

        $data = $request->all();

        if($data['payment_method'] === 'cod'){
            $order->placeOrderWithCOD();
        }
        else{
            // handle payment gateway here
        }

        return redirect()->to('');
    }
}
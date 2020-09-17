<?php

namespace bachphuc\Shopy\Http\Controllers;

use Illuminate\Http\Request;

use bachphuc\Shopy\Facades\ShopyFacade as Shopy;
use bachphuc\Shopy\Models\Product;

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
        return Shopy::view('carts.checkout', []);
    }

    public function paymentMethod(Request $request){
        // create new or update payment
        
        return Shopy::view('carts.payment-method', []);
    }

    public function placeOrder(Request $request){

    }
}
@extends(Shopy::layout())

@section('content')
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="coupon__link"><span class="icon_tag_alt"></span> <a href="#">Have a coupon?</a> Click here to enter your code.</h6>
                </div>
            </div>
            <form action="{{route('carts.place-order')}}" class="checkout__form" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-8">
                        <h5>PAYMENT METHOD</h5>
                        <div class="row"> 
                            <div class="col-lg-12 payment-methods">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="exampleRadios1" value="cod" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                    Cash on Delivery (COD)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="exampleRadios2" value="international_card">
                                    <label class="form-check-label" for="exampleRadios2">
                                    Visa/Mastercard
                                    </label>
                                </div>
                                <div class="form-check disabled">
                                    <input class="form-check-input" type="radio" name="payment_method" id="exampleRadios3" value="bank_transfer" disabled>
                                    <label class="form-check-label" for="exampleRadios3">
                                    Bank Transfer
                                    </label>
                                </div>
                            </div>                           
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout__order">
                            <h5>Your order</h5>
                            <div class="checkout__order__product">
                                <ul>
                                    <li>
                                        <span class="top__text">Product</span>
                                        <span class="top__text__right">Total</span>
                                    </li>
                                    @foreach(Shopy::cart()->items() as $key => $item)
                                    <li>{{$key}}. {{$item->product->getTitle()}} X <strong>{{$item->count}}</strong> <span>$ {{$item->amount}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="checkout__order__total">
                                <ul>
                                    <li>Subtotal <span>$ {{Shopy::cartAmount()}}</span></li>
                                    <li>Total <span>$ {{Shopy::cartAmount()}}</span></li>
                                </ul>
                            </div>
                            <div class="checkout__order__widget">
                                <label for="o-acc">
                                    Create an account?
                                    <input type="checkbox" id="o-acc">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Create an account by entering the information below. If you are a returing customer
                                login at the top of the page.</p>
                                <label for="check-payment">
                                    Cheque payment
                                    <input type="checkbox" id="check-payment">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="paypal">
                                    PayPal
                                    <input type="checkbox" id="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <button type="submit" class="site-btn">Place oder</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
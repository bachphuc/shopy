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
            <form action="{{route('carts.payment-method')}}" class="checkout__form" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-8">
                        <h5>SHIPPING INFORMATION</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>First Name <span>*</span></p>
                                    <input name="first_name" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Last Name <span>*</span></p>
                                    <input name="last_name" type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                {{-- <div class="checkout__form__input">
                                    <p>Country <span>*</span></p>
                                    <input type="text">
                                </div> --}}
                                <div class="checkout__form__input">
                                    <p>Address <span>*</span></p>
                                    <input name="address" type="text" placeholder="1 cach mang thang 8">
                                    <input name="apartment" type="text" placeholder="Landmark 81">
                                </div>
                                <div class="checkout__form__input">
                                    <p>Town/Ward <span>*</span></p>
                                    <input name="ward" type="text">
                                </div>
                                <div class="checkout__form__input">
                                    <p>State/Province <span>*</span></p>
                                    <input type="text" name="province">
                                </div>
                                <div class="checkout__form__input">
                                    <p>District <span>*</span></p>
                                    <input type="text" name="district">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Phone <span>*</span></p>
                                    <input type="text" name="phone">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Email <span>*</span></p>
                                    <input type="text" name="email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__checkbox">
                                    <label for="note">
                                        Note about your order, e.g, special noe for delivery
                                        <input type="checkbox" id="note">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__form__input">
                                    <p>Oder notes <span>*</span></p>
                                    <input type="text"
                                    placeholder="Note about your order, e.g, special noe for delivery">
                                </div>

                                @if(!auth()->check())
                                <div class="checkout__form__checkbox">
                                    <label for="acc">
                                        Create an acount?
                                        <input type="checkbox" id="acc">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p>Create am acount by entering the information below. If you are a returing
                                        customer login at the <br />top of the page</p>
                                </div>
                                <div class="checkout__form__input">
                                    <p>Account Password <span>*</span></p>
                                    <input type="text">
                                </div>
                                @endif
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
                            <button type="submit" class="site-btn">NEXT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
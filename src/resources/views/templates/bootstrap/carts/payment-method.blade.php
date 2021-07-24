@extends(Shopy::layout())

@section('content')
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="coupon__link"><span class="icon_tag_alt"></span> <a href="#">@lang('shopy::lang.have_a_coupon')</a> @lang('shopy::lang.click_here_to_enter_your_coupon').</h6>
                </div>
            </div>
            <form action="{{route('carts.place-order')}}" class="checkout__form" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="address_id" value="{{$address->id}}">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>@lang('shopy::lang.payment_method')</h5>
                        <div class="row"> 
                            <div class="col-lg-12 payment-methods">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="exampleRadios1" value="cod" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                    @lang('shopy::lang.payment_cod')
                                    </label>
                                </div>
                                {{-- <div class="form-check disabled">
                                    <input class="form-check-input" type="radio" name="payment_method" id="exampleRadios2" value="international_card" disabled>
                                    <label class="form-check-label" for="exampleRadios2">
                                    @lang('shopy::lang.payment_international_card')
                                    </label>
                                </div>
                                <div class="form-check disabled">
                                    <input class="form-check-input" type="radio" name="payment_method" id="exampleRadios3" value="bank_transfer" disabled>
                                    <label class="form-check-label" for="exampleRadios3">
                                    @lang('shopy::lang.payment_bank_transfer')
                                    </label>
                                </div> --}}
                            </div>                           
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout__order">
                            <h5>@lang('shopy::lang.your_order')</h5>
                            <div class="checkout__order__product">
                                <ul>
                                    <li>
                                        <span class="top__text">@lang('shopy::lang.product')</span>
                                        <span class="top__text__right">@lang('shopy::lang.total')</span>
                                    </li>
                                    @foreach(Shopy::cart()->items() as $key => $item)
                                    <li>{{$key + 1}}. {{$item->product->getTitle()}} X <strong>{{$item->count}}</strong> <span>$ {{$item->amount}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="checkout__order__total">
                                <ul>
                                    <li>@lang('shopy::lang.subtotal') <span>{{Shopy::displayCartAmount()}}</span></li>
                                    <li>{{shopy_trans('lang.shipping_fee')}} <span>0</span></li>
                                    <li>@lang('shopy::lang.total') <span> {{Shopy::displayCartAmount()}}</span></li>
                                </ul>
                            </div>
                            @if(!auth()->check())
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
                            @endif
                            <button type="submit" class="site-btn">@lang('shopy::lang.place_order')</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
@extends(Shopy::layout())

@push('styles')
<style>
    .shipping-addresses{
        list-style: none;
    }
    .shipping-addresses li{
        margin-bottom: 16px;
    }
    .shipping-addresses input{
        opacity: 0;
        position: absolute;
        width: 1px;
        height: 1px;
    }
    .shipping-addresses label{
        border: 1px solid #e1e1e1;
        padding: 16px;
        border-radius: 4px;
        display: flex;
        flex-direction: row;
        align-items: center;
        cursor: pointer;
    }
    .shipping-addresses label:hover{
        background-color: rgba(202,21,21, 0.1);
    }
    .shipping-addresses input:checked+label{
        border-color: #ca1515;
    }
    .shipping-addresses label > span:first-child {
        content: '';
        width: 16px;
        height: 16px;
        display: block;
        border-radius: 100%;
        border: 1px solid red;
        position: relative;
        margin-right: 16px;
    }

    .shipping-addresses input:checked + label > span:first-child::after{
        content: '';
        width: 10px;
        height: 10px;
        display: block;
        border-radius: 100%;
        background-color: red;
        position: absolute;
        left: 2px;
        top: 2px;
    }
    .shipping-addresses label > span:last-child{
        flex: 1;
    }
</style>
@endpush

@section('content')
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="coupon__link"><span class="icon_tag_alt"></span> <a href="#">@lang('shopy::lang.have_a_coupon')</a> @lang('shopy::lang.click_here_to_enter_your_coupon').</h6>
                </div>
            </div>
            <form action="{{route('carts.payment-method')}}" class="checkout__form" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-8">
                        <h5>@lang('shopy::lang.shipping_information')</h5>

                        @if(Shopy::userShippingAddresses()->count())
                        <h5><input id="address_type_use_current" type="radio" name="address_type" value="use_current" checked> <label for="address_type_use_current">@lang('shopy::lang.select_your_shipping_address')</label></h5>
                        
                        <div>
                            @foreach(Shopy::userShippingAddresses() as $key => $address)
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="shipping-addresses">
                                        <li>
                                            <input {!! $key === 0 ? 'checked' : '' !!} id="address-item-{{$address->id}}" type="radio" name="address_id" value="{{$address->id}}" />
                                            <label for="address-item-{{$address->id}}">
                                                <span></span>
                                                <span>
                                                    <strong>{{$address->first_name}} {{$address->last_name}}, SDT: {{$address->phone}}</strong><br>
                                                    <span>{{$address->address}}, {{$address->ward}}, {{$address->district}}, {{$address->province}}</span>
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <h5><input type="radio" name="address_type" value="create_new" id="address_type_create_new"> <label for="address_type_create_new">@lang('shopy::lang.create_new_shipping_address')</label></h5>

                        @else
                        <input type="hidden" name="address_type" value="create_new">
                        @endif
                        
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>@lang('shopy::lang.first_name') <span>*</span></p>
                                    <input name="first_name" type="text" value="{{old('first_name')}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>@lang('shopy::lang.last_name') <span>*</span></p>
                                    <input name="last_name" type="text" value="{{old('last_name')}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                {{-- <div class="checkout__form__input">
                                    <p>Country <span>*</span></p>
                                    <input type="text">
                                </div> --}}
                                <div class="checkout__form__input">
                                    <p>@lang('shopy::lang.address') <span>*</span></p>
                                    <input name="address" type="text" placeholder="1 cach mang thang 8" value="{{old('address')}}" />
                                    {{-- <input name="apartment" type="text" placeholder="Landmark 81"> --}}
                                </div>
                                <div class="checkout__form__input">
                                    <p>@lang('shopy::lang.ward') <span>*</span></p>
                                    <input name="ward" type="text">
                                </div>
                                <div class="checkout__form__input">
                                    <p>@lang('shopy::lang.state_province') <span>*</span></p>
                                    <input type="text" name="province">
                                </div>
                                <div class="checkout__form__input">
                                    <p>@lang('shopy::lang.district') <span>*</span></p>
                                    <input type="text" name="district">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>@lang('shopy::lang.phone') <span>*</span></p>
                                    <input type="text" name="phone">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>@lang('shopy::lang.email') <span>*</span></p>
                                    <input type="text" name="email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__checkbox">
                                    <label for="note">
                                        @lang('shopy::lang.delivery_note')
                                        <input type="checkbox" id="note">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__form__input">
                                    <p>@lang('shopy::lang.order_note') <span>*</span></p>
                                    <input type="text" name="note" placeholder="@lang('shopy::lang.order_placeholder')">
                                </div>

                                @if(!auth()->check())
                                <div class="checkout__form__checkbox">
                                    <label for="acc">
                                        Create an acount?
                                        <input type="checkbox" id="acc">
                                        <span class="checkmark"></span>
                                    </label>
                                    <p>Create am acount by entering the information below. If you are a returing customer login at the <br />top of the page</p>
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
                            <h5>@lang('shopy::lang.your_order')</h5>
                            <div class="checkout__order__product">
                                <ul>
                                    <li>
                                        <span class="top__text">@lang('shopy::lang.product')</span>
                                        <span class="top__text__right">@lang('shopy::lang.total')</span>
                                    </li>
                                    @foreach(Shopy::cart()->items() as $key => $item)
                                    <li>{{$key}}. {{$item->product->getTitle()}} X <strong>{{$item->count}}</strong> <span>{{$item->displayAmount()}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="checkout__order__total">
                                <ul>
                                    <li>@lang('shopy::lang.subtotal') <span>{{Shopy::displayCartAmount()}}</span></li>
                                    <li>@lang('shopy::lang.total') <span>{{Shopy::displayCartAmount()}}</span></li>
                                </ul>
                            </div>
                            {{-- <div class="checkout__order__widget">
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
                            </div> --}}
                            <button type="submit" class="site-btn">@lang('shopy::lang.next')</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
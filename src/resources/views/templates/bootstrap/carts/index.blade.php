@extends(Shopy::layout())

@section('content')
    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>@lang('shopy::lang.product')</th>
                                    <th>@lang('shopy::lang.price')</th>
                                    <th>@lang('shopy::lang.quantity')</th>
                                    <th>@lang('shopy::lang.total')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Shopy::cart()->items() as $item)
                                <tr>
                                    <td class="cart__product__item">
                                        <img src="{{$item->product->getImage()}}" alt="">
                                        <div class="cart__product__item__title">
                                            <h6><a href="{{$item->product->getHref()}}">{{$item->product->getTitle()}}</a></h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">{{$item->displayPrice()}}</td>
                                    <td class="cart__quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="{{$item->count}}">
                                        </div>
                                    </td>
                                    <td class="cart__total">{{$item->displayAmount()}}</td>
                                    <td class="cart__close">
                                        <span class="icon_close" onclick="document.getElementById('item-{{$item->product_id}}').submit()"></span>
                                        @include(Shopy::viewPath('components.form-delete'), ['id' => $item->product_id, 'url' => Shopy::route('carts.destroy', ['id' => $item->product_id])])
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(!Shopy::cart()->items()->count())
                        <p class="mt-3">@lang('shopy::lang.cart_empty')</p>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="cart__total__procced">
                        <h6>{{shopy_trans('lang.cart_summary')}}</h6>
                        <ul>
                            <li>{{shopy_trans('lang.sub_total')}} <span>{{Shopy::displayCartAmount()}}</span></li>
                            <li>{{shopy_trans('lang.shipping_fee')}} <span>0</span></li>
                            <li>{{shopy_trans('lang.total_money')}} <span>{{Shopy::displayCartAmount()}}</span></li>
                        </ul>
                        <a href="{{Shopy::route('carts.checkout')}}" class="primary-btn">@lang('shopy::lang.process_to_checkout')</a>
                    </div>

                    {{-- <div class="discount__content mt-3">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">@lang('shopy::lang.apply')</button>
                        </form>
                    </div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="{{Shopy::route('products.index')}}">@lang('shopy::lang.continue_shopping')</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    {{-- <div class="cart__btn update__btn">
                        <a href="#"><span class="icon_loading"></span> Update cart</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->
@endsection
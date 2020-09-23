@extends(Shopy::layout())

@section('content')
    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
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
                                    <td class="cart__price">$ {{$item->price}}</td>
                                    <td class="cart__quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="{{$item->count}}">
                                        </div>
                                    </td>
                                    <td class="cart__total">$ {{$item->amount}}</td>
                                    <td class="cart__close">
                                        <span class="icon_close" onclick="document.getElementById('item-{{$item->product_id}}').submit()"></span>
                                        @include(Shopy::viewPath('components.form-delete'), ['id' => $item->product_id, 'url' => route('carts.destroy', ['id' => $item->product_id])])
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="{{route('products.index')}}">Continue Shopping</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    {{-- <div class="cart__btn update__btn">
                        <a href="#"><span class="icon_loading"></span> Update cart</a>
                    </div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="discount__content">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">Apply</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>$ {{Shopy::cartAmount()}}</span></li>
                            <li>Total <span>$ {{Shopy::cartAmount()}}</span></li>
                        </ul>
                        <a href="{{route('carts.checkout')}}" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->
@endsection
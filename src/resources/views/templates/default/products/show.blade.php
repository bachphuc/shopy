@extends(Shopy::layout())

@section('content')
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll">
                            @foreach($product->getImages() as $key => $img)
                            <a class="pt active" href="#product-{{$key+1}}">
                                <img src="{{$img->getImage()}}" alt="">
                            </a>
                            @endforeach
                        </div>
                        
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach($product->getImages() as $key => $img)
                                <img data-hash="product-{{$key + 1}}" class="product__big__img" src="{{$img->getImage()}}" alt="">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <form action="{{route('carts.store')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="product_id" value="{{$product->id}}" />
                            <h3>{{$product->getTitle()}} <span>Brand: SKMEIMore Men Watches from SKMEI</span></h3>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span>( 138 reviews )</span>
                            </div>
                            <div class="product__details__price">$ {{$product->price}} <span>$ 83.0</span></div>
                            <p>{{$product->description}}</p>
                            <div class="product__details__button">
                                <div class="quantity">
                                    <span>Quantity:</span>
                                    <div class="pro-qty">
                                        <input name="count" type="text" value="1" />
                                    </div>
                                </div>
                                <button class="cart-btn" type="submit"><span class="icon_bag_alt"></span> Add to cart</button>
                                <ul>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__details__widget">
                                <ul>
                                    <li>
                                        <span>Availability:</span>
                                        <div class="stock__checkbox">
                                            <label for="stockin">
                                                In Stock
                                                <input type="checkbox" id="stockin">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Available color:</span>
                                        <div class="color__checkbox">
                                            <label for="red">
                                                <input type="radio" name="color__radio" id="red" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                            <label for="black">
                                                <input type="radio" name="color__radio" id="black">
                                                <span class="checkmark black-bg"></span>
                                            </label>
                                            <label for="grey">
                                                <input type="radio" name="color__radio" id="grey">
                                                <span class="checkmark grey-bg"></span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Available size:</span>
                                        <div class="size__btn">
                                            <label for="xs-btn" class="active">
                                                <input type="radio" id="xs-btn">
                                                xs
                                            </label>
                                            <label for="s-btn">
                                                <input type="radio" id="s-btn">
                                                s
                                            </label>
                                            <label for="m-btn">
                                                <input type="radio" id="m-btn">
                                                m
                                            </label>
                                            <label for="l-btn">
                                                <input type="radio" id="l-btn">
                                                l
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Promotions:</span>
                                        <p>Free shipping</p>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( 2 )</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <h6>Description</h6>
                                <p>{{$product->description}}</p>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <h6>Specification</h6>
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                    quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                    Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                    voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                consequat massa quis enim.</p>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                quis, sem.</p>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <h6>Reviews ( 2 )</h6>
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                    quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                    Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                    voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                consequat massa quis enim.</p>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                quis, sem.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include(Shopy::viewPath('products.related'), ['product' => $product])
        </div>
    </section>
    <!-- Product Details Section End -->
@endsection
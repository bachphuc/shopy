<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="/"><img src="/assets/templates/default/img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/products">Women’s</a></li>
                        <li><a href="#">Men’s</a></li>
                        <li class="active"><a href="./shop.html">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./product-details.html">Product Details</a></li>
                                <li><a href="./shop-cart.html">Shop Cart</a></li>
                                <li><a href="./checkout.html">Checkout</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="./blog.html">Blog</a></li>
                        <li><a href="./contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <div class="header__right__auth">
                        @if(!auth()->check())
                        <a href="{{route('login')}}">Login</a>
                        <a href="{{route('register')}}">Register</a>
                        @else
                        <a href="{{Shopy::route('account.orders')}}">@lang('shopy::lang.welcome') <strong>{{user_name()}}</strong></a>
                        @endif
                    </div>
                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        {{-- <li>
                            <a href="#"><span class="icon_heart_alt"></span>
                                <div class="tip">2</div>
                            </a>
                        </li> --}}
                        <li class="cart_badge">
                            <a href="{{Shopy::route('carts.index')}}"><span class="icon_bag_alt"></span>
                                <div class="tip">{{Shopy::cartTotal()}}</div>
                            </a>
                            @include(Shopy::viewPath('components.mini-cart'))
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
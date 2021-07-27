<nav class="header__menu">
    @php
        $menus = Shopy::getHeaderMenus();
    @endphp
    <ul>
        @foreach($menus as $key => $menu)
        <li class="{{theme_is_active_menu($menu['key']) ? 'active' : ''}}">
            @if(isset($menu['url']))
            <a href="{{$menu['url']}}">{{shopy_trans($menu['title'])}}</a>
            @elseif(isset($menu['route']))
            <a href="{{route($menu['route'])}}">{{shopy_trans($menu['title'])}}</a>
            @endif
        </li>
        @endforeach
        {{-- <li><a href="/articles">Articles</a></li>
        <li><a href="">Contact</a></li> --}}
    </ul>
    {{-- <ul>
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
    </ul> --}}
</nav>
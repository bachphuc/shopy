<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ashion | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{Shopy::asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{Shopy::asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{Shopy::asset('css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{Shopy::asset('css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{Shopy::asset('css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{Shopy::asset('css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{Shopy::asset('css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{Shopy::asset('css/style.css')}}" type="text/css">

    @stack('styles')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_heart_alt"></span>
                <div class="tip">2</div>
            </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                <div class="tip">2</div>
            </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="/"><img src="{{Shopy::asset('img/logo.png')}}" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="#">Login</a>
            <a href="#">Register</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    @include(Shopy::viewPath('components.header'))
    <!-- Header Section End -->

    <!-- Breadcrumb Begin -->
    @include(Shopy::viewPath('components.breadcrumbs'))
    <!-- Breadcrumb End -->

    @yield('content')
    <!-- Shop Section End -->

    <!-- Instagram Begin -->
    <div class="instagram">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="{{Shopy::asset('img/instagram/insta-1.jpg')}}">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="{{Shopy::asset('img/instagram/insta-2.jpg')}}">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="{{Shopy::asset('img/instagram/insta-3.jpg')}}">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="{{Shopy::asset('img/instagram/insta-4.jpg')}}">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="{{Shopy::asset('img/instagram/insta-5.jpg')}}">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="{{Shopy::asset('img/instagram/insta-6.jpg')}}">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Instagram End -->

    <!-- Footer Section Begin -->
    @include(Shopy::viewPath('components.footer'))
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{Shopy::asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{Shopy::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{Shopy::asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{Shopy::asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{Shopy::asset('js/mixitup.min.js')}}"></script>
    <script src="{{Shopy::asset('js/jquery.countdown.min.js')}}"></script>
    <script src="{{Shopy::asset('js/jquery.slicknav.js')}}"></script>
    <script src="{{Shopy::asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{Shopy::asset('js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{Shopy::asset('js/main.js')}}"></script>

    <script>
        window.addEventListener('load', () => {
            
        });
    </script>
</body>

</html>
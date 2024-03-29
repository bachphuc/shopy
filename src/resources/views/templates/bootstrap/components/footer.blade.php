<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="/"><img src="{{shopy_site_logo()}}" alt="{{shopy_site_name()}}"></a>
                    </div>
                    <p><strong>{{setting('shopy_general.name')}}</strong>, {{setting('shopy_general.address')}}, {{setting('shopy_general.district')}}, {{setting('shopy_general.province')}}</p>
                    <p>Email: <a href="">{{setting('shopy_general.contact_email')}}</a></p>
                    <p>{{shopy_trans('lang.phone')}}: {{setting('shopy_general.contact_phone')}}</p>
                    <p>{{shopy_trans('lang.footer_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt cilisis.')}}</p>
                    {{-- <div class="footer__payment">
                        <a href="#"><img src="/assets/templates/default/img/payment/payment-1.png" alt=""></a>
                        <a href="#"><img src="/assets/templates/default/img/payment/payment-2.png" alt=""></a>
                        <a href="#"><img src="/assets/templates/default/img/payment/payment-3.png" alt=""></a>
                        <a href="#"><img src="/assets/templates/default/img/payment/payment-4.png" alt=""></a>
                        <a href="#"><img src="/assets/templates/default/img/payment/payment-5.png" alt=""></a>
                    </div> --}}
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <h6>Quick links</h6>
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Blogs</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>Account</h6>
                    <ul>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Orders Tracking</a></li>
                        <li><a href="#">Checkout</a></li>
                        <li><a href="#">Wishlist</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>NEWSLETTER</h6>
                    <form action="#">
                        <input type="text" placeholder="Email">
                        <button type="submit" class="site-btn">@lang('shopy::lang.subscribe')</button>
                    </form>
                    <div class="footer__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <div class="footer__copyright__text">
                    <p>{{shopy_trans('lang.copyright_text', 'Copyright Shopy © 2021')}}</p>
                </div>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </div>
        </div>
    </div>
</footer>
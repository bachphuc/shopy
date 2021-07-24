@extends(Shopy::layout())

@section('content')
    @php
        $activeMenu = isset($activeMenu) ? $activeMenu : 'orders';
    @endphp
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3">
                <div class="section-title mt-4 mb-4">
                    <h4 class="text-uppercase">@lang('shopy::lang.account')</h4>
                </div>
                <div class="list-group">
                    <a class="list-group-item border-0 {{$activeMenu == 'orders' ? 'active' : ''}}" href="{{Shopy::route('account.orders')}}">@lang('shopy::lang.your_orders')</a>
                    <a class="list-group-item border-0 {{$activeMenu == 'address' ? 'active' : ''}}" href="{{Shopy::route('addresses.index')}}">@lang('shopy::lang.shipping_address')</a>
                    <a class="list-group-item border-0" href="">@lang('shopy::lang.account')</a>
                    <a href="" class="list-group-item border-0" onclick="document.getElementById('logout-form').submit();return false;">@lang('shopy::lang.logout')
                        @include(shopy_viewpath('account.logout-form'))
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="mb-3">
                    @yield('account-content')
                </div>
            </div>
        </div>
    </div>
@endsection
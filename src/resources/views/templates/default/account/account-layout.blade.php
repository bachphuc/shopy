@extends(Shopy::layout())

@section('content')
    @php
        $activeMenu = isset($activeMenu) ? $activeMenu : 'orders';
    @endphp
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3">
                <h4 class="text-uppercase mb-3">@lang('shopy::lang.account')</h4>
                <div class="list-group">
                    <a class="list-group-item border-0 {{$activeMenu == 'orders' ? 'active' : ''}}" href="{{Shopy::route('account.orders')}}">@lang('shopy::lang.your_orders')</a>
                    <a class="list-group-item border-0 {{$activeMenu == 'address' ? 'active' : ''}}" href="{{Shopy::route('addresses.index')}}">@lang('shopy::lang.shipping_address')</a>
                    <a class="list-group-item border-0" href="">@lang('shopy::lang.account')</a>
                    <a href="" class="list-group-item border-0">@lang('shopy::lang.logout')</a>
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
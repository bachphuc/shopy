@extends(Shopy::adminLayout())

@push('styles')
<style>
ul.steps-bar {
    list-style: none;
    display: flex;
    margin: 0px;
    padding: 0px;
    flex-direction: row;
    margin-top: 16px;
}
.steps-bar li {
    display: inline-block;
    flex: 1;
}
.steps-bar li .step-slider{
    height: 8px;
    background-color: #4caf50;
    margin: 0px 6px;
    position: relative;
    border-radius: 4px;
}
.steps-bar li .step-text{
    text-align: center;
    margin: 16px 0px;
}
.steps-bar li:not(:last-child) .step-slider:before{
    content: '';
    display: block;
    position: absolute;
    width: 16px;
    height: 16px;
    background: #4caf50;
    border-radius: 100%;
    top: -4px;
    right: -8px;
    border: 2px solid #fff;
}
.steps-bar li:not(:last-child) .step-slider::after {
    content: '';
    display: block;
    position: absolute;
    width: 8px;
    height: 8px;
    background: #fff;
    border-radius: 100%;
    top: 0px;
    right: -4px;
}

.steps-bar li.active .step-slider::before{
    width: 24px;
    height: 24px;
    top: -8px;
    right: -12px;
    border: 3px solid #fff;
}

.steps-bar li.active ~ li .step-slider{
    background-color: #e1e1e1;
}

.steps-bar li.active ~ li .step-slider::before{
    background-color: #e1e1e1;
}
.steps-bar li.active ~ li .step-slider::after{
    background-color: #fff;
}

.steps-bar li.processing .step-slider{
    background-color: #ffbc00;
}

.steps-bar li.processing .step-slider::before{
    background-color: #ffbc00;
}

</style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title text-uppercase">@lang('shopy::lang.order_detail') #{{$order->id}}</h4>
                    </div>
                    <div class="card-content card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <ul class="steps-bar">
                                            @foreach($steps as $key => $step)
                                            <li class="{{isset($step['active']) && $step['active'] ? 'active' : ''}} {{isset($step['processing']) && $step['processing'] ? 'processing' : ''}}">
                                                <div class="step-slider"></div>
                                                <div class="step-text">{{$step['title']}}</div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <h4 class="text-uppercase">@lang('shopy::lang.order_information')</h4>
                                    <div>
                                        {!! $orderTable->render() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="text-uppercase">@lang('shopy::lang.products')</h4>
                                    <div>
                                        {!! $productTable->render() !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h4 class="text-uppercase">@lang('shopy::lang.confirm_order')</h4>
                                    <div>
                                        @if(!$order->isAdminConfirm() && !$order->isSuccess())
                                        {{-- confirm order form --}}
                                        <form action="{{Shopy::adminRoute('orders.confirm', ['order' => $order])}}" method="POST">
                                            {{ csrf_field() }}
                                            <p>@lang('shopy::lang.please_confirm_order')</p>
                                            <button type="submit" class="btn btn-block btn-success">@lang('shopy::lang.confirm_order')</button>
                                        </form>
                                        @else
                                        <p><span class="material-icons">verified</span> @lang('shopy::lang.order_confirmed')</p>
                                        @endif
                                    </div>
                                    @if(!$order->isSuccess() && $order->isAdminConfirm())
                                        @if($order->isDeliveryPending())
                                        {{-- confirm delivery success --}}
                                        <h4 class="text-uppercase">@lang('shopy::lang.delivery_status')</h4>
                                        <div>
                                            <form action="{{Shopy::adminRoute('orders.start-delivery', ['order' => $order])}}" method="POST">
                                                {{ csrf_field() }}
                                                <p>@lang('shopy::lang.order_is_pending_delivery')</p>
                                                <button type="submit" class="btn btn-block btn-success">@lang('shopy::lang.start_delivery')</button>
                                            </form>
                                        </div>
                                        @elseif($order->isDeliveryInProgress())
                                        {{-- confirm delivery success --}}
                                        <h4 class="text-uppercase">@lang('shopy::lang.confirm_delivery')</h4>
                                        <div>
                                            <form action="{{Shopy::adminRoute('orders.confirm-delivery', ['order' => $order])}}" method="POST">
                                                {{ csrf_field() }}
                                                <p>@lang('shopy::lang.is_this_order_delivery')</p>
                                                <button type="submit" class="btn btn-block btn-success">@lang('shopy::lang.yes_confirm_delivery')</button>
                                            </form>
                                        </div>
                                        @endif
                                    @endif

                                    <h4 class="text-uppercase">@lang('shopy::lang.customer_information')</h4>
                                    <div>
                                        <div>
                                            <a href="{{Shopy::adminRoute('customers.show', ['id' => $order->user->id])}}">{{$order->user->name}}</a>
                                        </div>
                                        <div><a href="">{{$order->user->email}}</a></div>
                                    </div>
                                    <h4 class="text-uppercase">@lang('shopy::lang.shipping_information')</h4>
                                    <div>
                                        @if($order->address)
                                        <p>{{$order->address->address}}, {{$order->address->district}}, {{$order->address->province}}</p>
                                        <p>@lang('shopy::lang.phone'): {{$order->address->phone}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(!$order->isSuccess())
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <button class="btn btn-danger">@lang('shopy::lang.cancel_this_order')</button>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
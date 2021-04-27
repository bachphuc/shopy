@extends(Shopy::adminLayout())

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="green">
                        <h4 class="title text-uppercase">@lang('shopy::lang.customer_detail'): {{$user->name}}</h4>
                    </div>
                    <div class="card-content card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="text-uppercase">@lang('shopy::lang.orders')</h4>
                                    <div>
                                        {!! $orderTable->render() !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h4 class="text-uppercase">@lang('shopy::lang.customer_information')</h4>
                                    <div>
                                        <p class="text-primary">{{$user->name}}</p>
                                        <p>{{$user->email}}</p>
                                    </div>
                                    <h4 class="text-uppercase">@lang('shopy::lang.shipping_address')</h4>
                                    <div>
                                        @foreach(Shopy::addressesOf($user) as $address)
                                        <p>@lang('shopy::lang.phone'): {{$address->phone}}, {{$address->address}}, {{$address->district}}, {{$address->province}}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
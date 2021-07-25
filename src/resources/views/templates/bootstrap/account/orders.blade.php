@extends(Shopy::viewPath('account.account-layout'))

@section('account-content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title mt-4 mb-4"><h4>{{shopy_trans('lang.my_orders')}}</h4></div>
                    @php
                        $badges = [
                            'pending' => 'badge-secondary',
                            'success' => 'badge-success',
                            'admin_confirmed' => 'badge-primary',
                            'shipping_confirm' => 'badge-secondary',
                            'cancelled' => 'badge-danger'
                        ];
                    @endphp
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{shopy_trans('lang.date')}}</th>
                                    <th class="text-right">{{shopy_trans('lang.amount')}}</th>
                                    <th class="text-right">{{shopy_trans('lang.status')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td><a href="{{$order->getHref()}}">#{{$order->id}}</a></td>
                                    <td>{{$order->created_at}}</td>
                                    <td class="text-right">{{$order->displayAmount()}} <small class="text-uppercase">{{$order->currency}}</small></td>
                                    <td class="text-right"><span class="badge {{$badges[$order->status]}}">{{shopy_trans('lang.' . strtolower($order->status))}}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </section>
@endsection
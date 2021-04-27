@extends(Shopy::viewPath('account.account-layout'))

@section('account-content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="mb-3">MY ORDERS</h4>
                    @php
                        $badges = [
                            'pending' => 'badge-secondary',
                            'success' => 'badge-success',
                            'admin_confirmed' => 'badge-primary',
                            'shipping_confirm' => 'badge-secondary',
                        ];
                    @endphp
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th class="text-right">Amount</th>
                                    <th class="text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td><a href="{{$order->getHref()}}">#{{$order->id}}</a></td>
                                    <td>{{$order->created_at}}</td>
                                    <td class="text-right">{{$order->displayAmount()}} <small class="text-uppercase">{{$order->currency}}</small></td>
                                    <td class="text-right"><span class="badge {{$badges[$order->status]}}">{{$order->status}}</span></td>
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
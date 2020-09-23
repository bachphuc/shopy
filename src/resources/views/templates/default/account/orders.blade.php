@extends(Shopy::layout())

@section('content')
    <section class="shop-cart">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4>MY ORDERS</h4>
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td><a href="{{$order->getHref()}}">#{{$order->id}}</a></td>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{$order->amount}}</td>
                                    <td>{{$order->status}}</td>
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
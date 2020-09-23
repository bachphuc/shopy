@extends(Shopy::layout())

@section('content')
    <section class="shop-cart">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <h4>Order No#{{$order->id}}</h4>
                    </div>
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Count</th>
                                <th>Amount</th>
                            </thead>
                            <tbody>
                                @foreach($order->items() as $item)
                                <tr>
                                    <td><a href="{{$item->product->getHref()}}">{{$item->product->getTitle()}}</a></td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->count}}</td>
                                    <td>{{$item->currency}} {{$item->amount}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <h5><strong>Total</strong>: ${{$order->amount}}</h5>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
@endsection
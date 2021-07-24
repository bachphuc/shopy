@extends(Shopy::viewPath('account.account-layout'))

@section('account-content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title mt-4 mb-4">
                        <h4 class="text-uppercase">{{shopy_trans('lang.order')}} {{shopy_trans('lang.no')}} #{{$order->id}}</h4>
                    </div>
                    <div class="mt-3">
                        @include(Shopy::viewPath('components.order-steps'))
                    </div>
                    <div class="shop__cart__table mt-4">
                        <table>
                            <thead>
                                <th>{{shopy_trans('lang.image')}}</th>
                                <th>{{shopy_trans('lang.product')}}</th>
                                <th>{{shopy_trans('lang.price')}}</th>
                                <th class="text-right">{{shopy_trans('lang.count')}}</th>
                                <th class="text-right">{{shopy_trans('lang.amount')}}</th>
                            </thead>
                            <tbody>
                                @foreach($order->items() as $item)
                                <tr>
                                    <td>
                                        <img src="{{$item->product->getImage()}}" alt="{{$item->product->getTitle()}}" style="max-width: 72px;">
                                    </td>
                                    <td><a href="{{$item->product->getHref()}}">{{$item->product->getTitle()}}</a></td>
                                    <td>{{(int) $item->price}}</td>
                                    <td class="text-right">{{$item->count}}</td>
                                    <td class="text-uppercase text-right">{{(int) $item->amount}} <small>{{$item->currency}}</small></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <h5 class="text-right"><strong>{{shopy_trans('lang.total_money')}}</strong>: {{$order->displayAmount()}} <small class="text-uppercase">{{$order->currency}}</small></h5>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
@endsection
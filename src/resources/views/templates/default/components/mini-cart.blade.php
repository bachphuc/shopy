@php
    $full = isset($full) ? $full : true;   
    $newProductId = isset($newProductId) ? $newProductId : 0;
@endphp

@if($full)
<div id="mini-cart" class="mini-card {{request()->query('show_cart') == 1 ? 'active' : ''}}">
@endif
    @foreach(Shopy::cart()->items() as $item)
    <a class="mini-cart-item {{$newProductId == $item->product_id ? 'active' : ''}} " href="{{$item->product->getHref()}}">
        <div style="width: 72px;margin-right: 8px;">
            <img src="{{$item->product->getImage()}}" style="width: 72px;" />
        </div>
        <div>
            <h2 style="flex: 1; font-size: 0.9em;text-align: left;">{{$item->product->getTitle()}}</h2>
            <p>{{$item->count}} X {{$item->product->displayPrice()}}</p>
        </div>
    </a>
    @endforeach  
    <div style="height: 1px; background-color: #e1e1e1;"></div>
    <div style="margin-top: 16px;">
        <h4 style="font-size: 1em;">@lang('shopy::lang.total'): <span>{{Shopy::displayCartAmount()}}</span> <span>VNĐ</span></h4>
    </div>
    <div style="margin-top: 16px;">
        <a class="btn btn-primary btn-block" href="{{Shopy::route('carts.index')}}">@lang('shopy::lang.view_cart')</a>
    </div>

@if($full)
</div>

<script>
    window.addEventListener('load', () => {
        const miniCart = document.getElementById('mini-cart');
        if(miniCart && miniCart.classList.contains('active')){
            setTimeout(() => {
                miniCart.classList.remove('active');
            }, 3000);
        }

    });
</script>
@endif
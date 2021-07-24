@extends(Shopy::viewPath('account.account-layout'))

@section('account-content')
<section>
    <h4>@lang('shopy::lang.shipping_address')</h4>
    <div class="shop__cart__table mt-4">
        {!! $table->render() !!}
    </div>
</section>
@endsection
@extends(Shopy::layout())

@section('content')
    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    @include(Shopy::viewPath('components.filters'))
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        @foreach($products as $product)
                        @include(Shopy::viewPath('products.entry'), ['product' => $product])
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include(Shopy::viewPath('components.paginate'), ['items' => $products])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
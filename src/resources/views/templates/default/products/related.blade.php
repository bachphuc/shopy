<div class="row">
    <div class="col-lg-12 text-center">
        <div class="related__title">
            <h5>RELATED PRODUCTS</h5>
        </div>
    </div>

    @foreach($product->getRelated() as $item)
    @include(Shopy::viewPath('products.related-entry'), ['product' => $item])
    @endforeach
</div>
@extends(Shopy::layout())

@section('content')
@include(Shopy::viewPath('components.home-featured-categories'))
<!-- Product Section Begin -->
@element('shopy::new-product-block')
<!-- Product Section End -->

@element('articles::article-columns-block')

@element('articles::new-articles-block')

<!-- Banner Section Begin -->
{{-- @include(Shopy::viewPath('components.slider-banner')) --}}
<!-- Banner Section End -->

<!-- Trend Section Begin -->
{{-- @element('shopy::trending') --}}
<!-- Trend Section End -->

<!-- Discount Section Begin -->
{{-- @include(Shopy::viewPath('components.discount-feature')) --}}
<!-- Discount Section End -->

<!-- Services Section Begin -->
{{-- @include(Shopy::viewPath('components.service-block')) --}}
<!-- Services Section End -->
@endsection
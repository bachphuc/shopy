<!-- Categories Section Begin -->
@php
    $categories = Shopy::categories();
@endphp

@if(size_of($categories) >= 6)
<section class="categories">
    <div class="container-fluid">
        <div class="row">
            @foreach($categories as $key => $category)
            @if($key === 0)
            <div class="col-lg-6 p-0">
                <div class="categories__item categories__large__item set-bg"
                data-setbg="{{$category->getImage()}}">
                    <div class="categories__text">
                        <h4>{{$category->getTitle()}}</h4>
                        <p>Sitamet, consectetur adipiscing elit, sed do eiusmod tempor incidid-unt labore
                        edolore magna aliquapendisse ultrices gravida.</p>
                        <a href="{{$category->getHref()}}">Shop now</a>
                    </div>
                </div>
            </div>
            @endif

            @endforeach

            <div class="col-lg-6">
                <div class="row">
                    @foreach($categories as $key => $category)
                    @if($key > 0 && $key < 5)
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="{{$category->getImage()}}">
                            <div class="categories__text">
                                <h4>{{$category->getTitle()}}</h4>
                                <p>358 items</p>
                                <a href="{{$category->getHref()}}">Shop now</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@if(isset($breadcrumbs))
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    @foreach($breadcrumbs as $key => $breadcrumb)
                    @if(isset($breadcrumb['url']))
                    <a href="{{$breadcrumb['url']}}">
                        @if(isset($breadcrumb['icon']))
                        {!! $breadcrumb['icon'] !!}
                        @endif
                        {{$breadcrumb['title']}}
                    </a>
                    @else
                    <span>{{$breadcrumb['title']}}</span>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
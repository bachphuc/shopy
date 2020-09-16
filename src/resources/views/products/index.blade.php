@extends('bachphuc.shopy::layouts.layout')

@section('content')
    <h2>Product list</h2>
    <div>
        @foreach($products as $product)
        <div>
            <h4><a href="{{$product->getHref()}}">{{$product->getId()}} - {{$product->getTitle()}}</a></h4>
            <div>
                <img style="width: 128px;" src="{{$product->getImage()}}" />
            </div>
        </div>
        @endforeach
    </div>
@endsection
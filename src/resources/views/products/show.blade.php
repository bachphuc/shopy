@extends('bachphuc.shopy::layouts.layout')
@section('content')
    <h1>Product {{$product->title}}</h1>
    <div>
        @if(!empty($product->image))
        <img src="{{$product->getImage()}}" alt="">
        @endif
        <p>{{$product->description}}</p>
    </div>
@endsection
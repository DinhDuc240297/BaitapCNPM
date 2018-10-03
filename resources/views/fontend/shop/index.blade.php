@extends('fontend.layouts.master')

@section ('title','Shop')

@section('content')

	@foreach($products->chunk(3) as $productChuck)
	<div class="row">
		@foreach($productChuck as $product)
	  <div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      <img src="/img/items/{{$product->picture}}" alt=".." />
	      <div class="caption">
	        <p class="alias">{{$product->alias}}</p>
	        <p class="description">{{$product->description}}</p>
	        <div class="clearfix">
	        <div class="pull-left price">{{$product->price}} VNĐ</div>
	        
	         <a href="{{route('product.addcart',['id' => $product->id])}}" class="btn btn-success pull-right">Add to cart</a>
	     	</div>
	      </div>
	    </div>
	  </div>
	  @endforeach
	</div>
	@endforeach
@endsection
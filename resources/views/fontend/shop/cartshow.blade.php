@extends('fontend.layouts.master')

@section ('title','Show Cart')

@section('content')

@if(Session::has('cart'))
	<div class="row">
		<table class="table table-hover table-bordered">
			<thead >
				<tr>
					<th>STT</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody> 
				<?php $i=0; $total=0; ?>
				@foreach($products as $product)
				<?php $subtotal = $product['price']*$product['qty']; ?>
					<tr>
					<td>{{ ++$i}}</td>
					<td>{{ $product['name'] }}</td>
					<td>{{ $product['price'] }}</td>
					<td>{{ $product['qty'] }}</td>
					<td>{{ $subtotal }} VND</td>
					</tr>
				@endforeach
				<?php $total = $total + $subtotal ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>Total: </td>
						<td>{{ $total }} VNĐ</td>
					</tr>
			</tbody>
		</table>
		
	</div>

@else
@endif
@endsection
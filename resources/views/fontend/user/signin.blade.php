

@extends('fontend.layouts.master')
@section('title','Sign in')
@section('content')

<div class="row">
	<div class="col-md-4 col-md-offset-4">

		<div class="text-head" style="font-size: 20px;font-weight: bold;color: #001ca5;text-align: center;">
			Sign in
		</div><br>
		@if(count($errors) > 0)
			<div class="alert alert-danger">
				@foreach($errors->all() as $error)
					<p>{{ $error }}</p>
				@endforeach
			</div>
		@endif
		<form action="{{ route('user.signin')}}" method="post">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" id="email" name="email" class="form-control" placeholder="email" value="{{old('email')}}">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" id="password" name="password" class="form-control" placeholder="Password">
			</div>
			<button type="submit" class="btn btn-primary">Sign Up</button>
			{{ csrf_field() }}
		</form>

	</div>
</div>
@endsection
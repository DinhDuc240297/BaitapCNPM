@extends('layouts.app')

@section('content')
<div class="container">
    <form class="login-form" action="{{url('login')}}" method="post">
      {!!csrf_field()!!}
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        @if($errors->has('errorlogin'))
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{$errors->first('errorlogin')}}
            </div>
        @endif
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="email" name="email" class="form-control" placeholder="Username" autofocus value="{!!old('email')!!}">
        </div>
            @if($errors->has('email'))
              <p style="color:red">{{$errors->first('email')}}</p>
            @endif
       
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" name="password" class="form-control" placeholder="Password" >
        </div>
            @if($errors->has('password'))
              <p style="color:red">{{$errors->first('password')}}</p>
            @endif
        <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
            </label>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
        <button class="btn btn-info btn-lg btn-block" type="submit">Signup</button>
      </div>
    </form>
  </div>

@endsection

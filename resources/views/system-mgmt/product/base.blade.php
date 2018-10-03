@extends('layouts.app-template')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Product Mangement</a></li>
        <li class="active">Product</li>
      </ol>
    </section>
    @yield('action-content')
    <!-- /.content -->
  </div>
@endsection
@extends('system-mgmt.state.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new state</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('state.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Mô tả</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('unit_price') ? ' has-error' : '' }}">
                            <label for="unit_price" class="col-md-4 control-label">Giá khuyến mãi</label>
                            <div class="col-md-6">
                                <input id="unit_price" type="text" class="form-control" name="unit_price" value="{{ old('unit_price') }}" required>

                                @if ($errors->has('unit_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('unit_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                            <label for="unit" class="col-md-4 control-label">Đơn vị</label>
                            <div class="col-md-6">
                                <input id="unit" type="text" class="form-control" name="unit" value="{{ old('unit') }}" required>

                                @if ($errors->has('unit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('unit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                            <label for="color" class="col-md-4 control-label">Color</label>
                            <div class="col-md-6">
                                <input id="color" type="text" class="form-control" name="color" value="{{ old('color') }}" required>

                                @if ($errors->has('color'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('color') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                            <label for="size" class="col-md-4 control-label">Size</label>
                            <div class="col-md-6">
                                <input id="size" type="text" class="form-control" name="size" value="{{ old('size') }}" required>

                                @if ($errors->has('size'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('size') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

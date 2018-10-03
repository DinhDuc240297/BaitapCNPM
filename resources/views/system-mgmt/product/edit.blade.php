@extends('system-mgmt.product.base')

@section('action-content')
<div class="container-wapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">
							<b>Sửa sản phẩm</b>
						</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12 col-xs-12">
								<form action="{{ route('product.update', ['id' => $products->id]) }}" method="POST" enctype="multipart/form-data" >
								
									{{ csrf_field() }}
									<div class="row">
										<div class="col-sm-12 col-xs-12">
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Tên sản phẩm</label>
													<input class="form-control" id="name" type="text" required="" name="name" placeholder="Tên sản phẩm" value="{{$products -> name}}">
													@if ($errors->has('name'))
													<span class="help-block">
														<strong>{{ $errors->first('name') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Alias</label>
													<input class="form-control" type="text" id="alias" name="alias" required="" placeholder="alias" value="{{$products->alias}}">
													@if ($errors->has('alias'))
													<span class="help-block">
														<strong>{{ $errors->first('alias') }}</strong>
													</span>
													@endif
												</div>
											</div>

											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Price</label>
													<input class="form-control" type="text" id="price" name="price" required="" placeholder="Giá bán" value="{{$products->price}}">
													@if ($errors->has('price'))
													<span class="help-block">
														<strong>{{ $errors->first('price') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Unit</label>
													<input class="form-control" type="text" id="unit_product" name="unit_product" required="" placeholder="Đơn giá" value="{{$products->unit_product}}">
													@if ($errors->has('unit_product'))
													<span class="help-block">
														<strong>{{ $errors->first('unit_product') }}</strong>
													</span>
													@endif
												</div>
											</div>

											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Intro</label>
													<input class="form-control" type="text" id="intro" name="intro" required="" placeholder="Giới thiệu" value="{{$products->intro}}">
													@if ($errors->has('intro'))
													<span class="help-block">
														<strong>{{ $errors->first('intro') }}</strong>
													</span>
													@endif
												</div>
											</div>
											
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>color</label>
													<input class="form-control" type="text" id="color" name="color" required="" placeholder="Màu" value="{{$products->color}}">
													@if ($errors->has('color'))
													<span class="help-block">
														<strong>{{ $errors->first('color') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>size</label>
													<input class="form-control" type="text" id="size" name="size" required="" placeholder="Size" value="{{$products->size}}">
													@if ($errors->has('size'))
													<span class="help-block">
														<strong>{{ $errors->first('size') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>keywords</label>
													<input class="form-control" type="text" id="keywords" name="keywords" required="" placeholder="Từ khóa" value="{{$products->keywords}}">
													@if ($errors->has('keywords'))
													<span class="help-block">
														<strong>{{ $errors->first('keywords') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>description</label>
													<input class="form-control" type="text" id="description" name="description" required="" placeholder="Miêu tả" value="{{$products->description}}">
													@if ($errors->has('description'))
													<span class="help-block">
														<strong>{{ $errors->first('description') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Picture</label>
                                					
                                					<div class="">
                                						<input type="file" id="picture" name="picture"/>
                                						{{$products->picture}}
                                					</div>
												</div>
											</div>

											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Người đăng</label>
													<select class="form-control select2" name="user_id">
														@foreach ($users as $user)
					                                        <option {{$products->user_id == $user->id ? 'selected' : ''}} value="{{$user->id}}">{{$user->username}}</option>
					                                    @endforeach
													</select>

												</div>
											</div>

											<div class="col-sm-6 col-xs-12">	
												<div class="form-group">
													<label>Category</label>
													<select class="form-control select2" name="user_id">
													@foreach ($cates as $cate)
					                                    <option {{$products->cate_id == $cate->id ? 'selected' : ''}} value="{{$cate->id}}">{{$cate->name}}</option>
					                                @endforeach
					                            	</select>
												</div>
											</div>

										</div>
									</div>
									<div class="col-sm-12 col-xs-12 text-center">
										<button type="submit" class="button-col12 btn btn-success btn-block">
		                                    Create
		                                </button>
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Panel -->
		</div>
	</section>
</div>
@endsection

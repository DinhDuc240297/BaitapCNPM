@extends('system-mgmt.product.base')

@section('action-content')
<div class="container-wapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">
							<b>Thêm mới sản phẩm</b>
						</h3>
					</div>
					<div class="box-body">
						<div class="row">

							<div class="col-sm-12 col-xs-12">
								<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" >
								
									{{ csrf_field() }}
									<div class="row">
										<div class="col-sm-12 col-xs-12">
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Tên sản phẩm</label>
													<input class="form-control" id="name" type="text" required="" name="name" placeholder="Tên sản phẩm" value="">
													@if ($errors->has('name'))
													<span class="help-block">
														<strong>{{ $errors->first('name') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Bí danh</label>
													<input class="form-control" type="text" id="alias_keyword" name="alias_keyword" required="" placeholder="Bí danh" value="">
													@if ($errors->has('alias_keyword'))
													<span class="help-block">
														<strong>{{ $errors->first('alias_keyword') }}</strong>
													</span>
													@endif
												</div>
											</div>

											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Giá</label>
													<input class="form-control" type="text" id="price" name="price" required="" placeholder="Giá bán" value="">
													@if ($errors->has('price'))
													<span class="help-block">
														<strong>{{ $errors->first('price') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Đơn vị</label>
													<input class="form-control" type="text" id="unit_product" name="unit_product" required="" placeholder="Đơn vị" value="">
													@if ($errors->has('unit_product'))
													<span class="help-block">
														<strong>{{ $errors->first('unit_product') }}</strong>
													</span>
													@endif
												</div>
											</div>

											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Giới thiệu</label>
													<input class="form-control" type="text" id="intro" name="intro" required="" placeholder="Giới thiệu" value="">
													
												</div>
											</div>
											
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Màu sắc</label>
													<input class="form-control" type="text" id="color" name="color" required="" placeholder="Màu" value="">
													@if ($errors->has('color'))
													<span class="help-block">
														<strong>{{ $errors->first('color') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Size</label>
													<input class="form-control" type="text" id="size" name="size" required="" placeholder="size" value="">
													@if ($errors->has('size'))
													<span class="help-block">
														<strong>{{ $errors->first('size') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Số lượng</label>
													<input class="form-control" type="text" id="quantity" name="quantity" required="" placeholder="Số lượng nhập vào" value="">
													@if ($errors->has('quantity'))
													<span class="help-block">
														<strong>{{ $errors->first('quantity') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Miêu tả</label>
													<input class="form-control" type="text" id="description" name="description" required="" placeholder="Miêu tả" value="">
													
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Status</label>
													<input class="form-control" type="text" id="status" name="status" required="" placeholder="Trạng thái" value="">
													
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Hình Ảnh</label>
													<input class="form-control" type="file" id="picture" name="picture" required>
													@if ($errors->has('picture'))
													<span class="help-block">
														<strong>{{ $errors->first('pricture') }}</strong>
													</span>
													@endif
												</div>
											</div>

											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Người đăng</label>
													<select class="form-control select2" name="user_id">
														<option value="-1" selected="selected">Chọn người đăng</option>
														@foreach ($users as $user)
														<option value="{{$user->id}}">{{$user->username}}</option>
														@endforeach
													</select>

												</div>
											</div>

											<div class="col-sm-6 col-xs-12">	
												<div class="form-group">
													<label>Loại sản phẩm</label>
													<select class="form-control select2" name="cate_id">
														<option value="-1" selected="selected">Chọn loại sản phẩm</option>
														@foreach ($cates as $cate)
														<option value="{{$cate->id}}">{{$cate->name}}</option>
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

@extends('system-mgmt.promotion.base')

@section('action-content')
<div class="container-wapper">
	<section class="content">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">
							<b>Thêm mới khuyến mãi</b>
						</h3>
					</div>
					<div class="box-body">
						<div class="row">

							<div class="col-sm-12 col-xs-12">
								<form action="{{ route('promotion.store') }}" method="POST" enctype="multipart/form-data" >
								
									{{ csrf_field() }}
									<div class="row">
										<div class="col-sm-12 col-xs-12">
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Tên sản phẩm</label>
													<select class="form-control select2" name="product_id">
														<option value="-1" selected="selected">Chọn sản phẩm</option>
														@foreach ($products as $product)
														<option value="{{$product->id}}">{{$product->name}}</option>
														@endforeach
													</select>

												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Phần trăm giảm giá</label>
													<input class="form-control" type="text" id="total_sales" name="total_sales" required="" placeholder="%" value="">
													@if ($errors->has('total_sales'))
													<span class="help-block">
														<strong>{{ $errors->first('total_sales') }}</strong>
													</span>
													@endif
												</div>
											</div>

											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Mã code giảm giá</label>
													<input class="form-control" type="text" id="code_sales" name="code_sales" required="" placeholder="Mã giảm giá" value="">
													@if ($errors->has('code_sales'))
													<span class="help-block">
														<strong>{{ $errors->first('code_sales') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Ghi chú</label>
													<input class="form-control" type="text" id="note" name="note" required="" placeholder="Ghi chú" value="">
													@if ($errors->has('note'))
													<span class="help-block">
														<strong>{{ $errors->first('note') }}</strong>
													</span>
													@endif
												</div>
											</div>
											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
									                <label>Ngày bắt đầu:</label>
									                <div class="input-group date">
									                  <div class="input-group-addon">
									                    <i class="fa fa-calendar"></i>
									                  </div>
									                  <input type="text" class="form-control pull-right" name="date_start" id="date_start">
									                </div>
									                <!-- /.input group -->
									            </div>
											</div>

											<div class="col-sm-6 col-xs-12">
												<div class="form-group">
									                <label>Ngày kết thúc:</label>
									                <div class="input-group date">
									                  <div class="input-group-addon">
									                    <i class="fa fa-calendar"></i>
									                  </div>
									                  <input type="text" class="form-control pull-right" name="date_finish" id="date_finish">
									                </div>
									                <!-- /.input group -->
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

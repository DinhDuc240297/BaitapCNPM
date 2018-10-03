@extends('system-mgmt.product.base')
@section('action-content')
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">Danh sách sản phẩm</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('product.create') }}">Add new Product</a>
        </div>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('product.search') }}">
       {{ csrf_field() }}
       @component('layouts.search', ['title' => 'Search'])
       @component('layouts.two-cols-search-row', ['items' => ['Name'], 
       'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
       @endcomponent
       @endcomponent
     </form>
     <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
        	<div></div>
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Picture: activate to sort column descending" aria-sort="ascending">Picture</th>
                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Type Product</th>
                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Name</th>
                <th class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Birthdate: activate to sort column ascending">Intro</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="HiredDate: activate to sort column ascending">Color</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Size</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Quantity</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Status</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">User Post</th>
                <th width="15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr role="row" class="odd">
                <td><img src="/img/items/{{$product->picture}}" width="50px" height="50px"/></td>
                <td>{{ $product->cate_name }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->intro }}</td>
                <td>{{ $product->color }}</td>
                <td>{{ $product->size }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->user_name }}</td>
                <td>
                  <form class="row" method="POST" action="{{ route('product.destroy', ['id' => $product->id]) }}" onsubmit = "return confirm('Bạn chắc chắn xóa?')">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin tooltip-left" data-tooltip="Sửa">
                      <i class="fa fa-refresh"></i>
                    </a>
                    <button type="submit" class="btn col-sm-3 col-xs-5 btn-margin1 tooltip-left" data-tooltip="Xóa">
                      <i class="glyphicon glyphicon-trash"></i>
                    </button>
                    <button type="button" class="btn btn-danger col-sm-3 col-xs-5 btn-margin tooltip-left" data-toggle="modal" data-target="#modal-default" data-tooltip="Chi tiết">
                     <i class="glyphicon glyphicon-eye-open"></i>
                   </button>
                 </form>
               </td>
             </tr>
             <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Setting ....</h4>
                    </div>
                    <div class="modal-body">
                      <p>{{ $product->name }}</p>
                      <p>{{ $product->description }}</p>
                          
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Picture: activate to sort column descending" aria-sort="ascending">Picture</th>
                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Type Product</th>
                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Name</th>
                <th class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Birthdate: activate to sort column ascending">Intro</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="HiredDate: activate to sort column ascending">Color</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Size</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Quantity</th>
                
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Status</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">User Post</th>
                <th width="15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($products)}} of {{count($products)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
</section>
<!-- /.content -->
</div>
@endsection
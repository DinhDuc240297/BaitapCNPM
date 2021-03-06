@extends('system-mgmt.product-type.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Type Product</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('product-type.create') }}">Add new type product</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('product-type.search') }}">
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
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Name</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Alias</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Order</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Keywords</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Description</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Status</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($cates as $cate)
                <tr role="row" class="odd">
                  <td>{{ $cate->name }}</td>
                  <td>{{ $cate->alias }}</td>
                  <td>{{ $cate->order }}</td>
                  <td>{{ $cate->keywords }}</td>
                  <td>{{ $cate->description }}</td>
                  <td>{{ $cate->status }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('product-type.destroy', ['id' => $cate->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('product-type.edit', ['id' => $cate->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin tooltip-left" data-tooltip="Sửa">
                        <i class="fa fa-refresh"></i>
                        </a>
                        <button type="submit" class="btn col-sm-3 col-xs-5 btn-margin1 tooltip-left" data-tooltip="Xóa">
                        <i class="glyphicon glyphicon-trash"></i>
                        </button>
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>

                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Name</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Alias</th>
                <th wclass="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Order</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Keywords</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Description</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Status</th>
                <th rowspan="1" colspan="2">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($cates)}} of {{count($cates)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $cates->links() }}
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
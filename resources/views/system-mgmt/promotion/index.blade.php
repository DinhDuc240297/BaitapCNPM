@extends('system-mgmt.promotion.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of promotion</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('promotion.create') }}">Add new promotion</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('promotion.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Product sale'], 
          'oldVals' => [isset($searchingVals) ? $searchingVals['product_name'] : '']])
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
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Product</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">% sales</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Code</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Date Start</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Date Finish</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($promotions as $promotion)
                <tr role="row" class="odd">
                  <td>{{ $promotion->product_name }}</td>
                  <td>{{ $promotion->total_sales }}</td>
                  <td>{{ $promotion->code_sales }}</td>
                  <td>{{ $promotion->date_start }}</td>
                  <td>{{ $promotion->date_finish }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('promotion.destroy', ['id' => $promotion->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('promotion.edit', ['id' => $promotion->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin tooltip-left" data-tooltip="Sửa">
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
				<th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Product</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Total</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Code</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Date Start</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="dinhduc: activate to sort column ascending">Date Finish</th>
                <th rowspan="1" colspan="2">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($promotions)}} of {{count($promotions)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $promotions->links() }}
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
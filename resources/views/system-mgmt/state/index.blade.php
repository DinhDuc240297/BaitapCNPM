@extends('system-mgmt.state.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of states</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('state.create') }}">Add new state</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('state.search') }}">
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
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
             <tr role="row">
                <th width="8%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Picture: activate to sort column descending" aria-sort="ascending">Hình Ảnh</th>
                <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">tên</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending">Mô tả</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="UnitPrice: activate to sort column ascending">Đơn giá</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="PromotionPrice: activate to sort column ascending">Giá Khuyến mãi</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Unit: activate to sort column ascending">Đơn vị</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Color: activate to sort column ascending">Màu</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Size: activate to sort column ascending">Size</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Hoạt động</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($states as $state)
                <tr role="row" class="odd">
                  <td><img src="../{{$state->picture }}" width="50px" height="50px"/></td>
                  <td class="sorting_1">{{ $state->name }}</td>
                  <td class="hidden-xs">{{ $state->description }}</td>
                  <td class="hidden-xs">{{ $state->unit_price }}</td>
                  <td class="hidden-xs">{{ $state->upromotion_price }}</td>
                  <td class="hidden-xs">{{ $state->unit }}</td>
                  <td class="hidden-xs">{{ $state->color }}</td>
                  <td class="hidden-xs">{{ $state->size }}</td>
                  <td>
                  
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="20%" rowspan="1" colspan="1">State Name</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="country: activate to sort column ascending">Country Name</th>
                <th rowspan="1" colspan="2">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($states)}} of {{count($states)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $states->links() }}
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
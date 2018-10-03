@extends('customer-mgmt.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">Danh sách Khách hàng</h3>
        </div>

    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('customer-management.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['User Name', 'Email'], 
          'oldVals' => [isset($searchingVals) ? $searchingVals['username'] : '', isset($searchingVals) ? $searchingVals['Email'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
<!--                 <th width="8%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Picture: activate to sort column descending" aria-sort="ascending">Hình Ảnh</th> -->
                <th  class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label=UserName: activate to sort column descending" aria-sort="ascending">UserName</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="fullname: activate to sort column ascending">FullName</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Sex: activate to sort column ascending">Sex</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Mobile: activate to sort column ascending">Mobile</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Address</th>
                <th width="15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($customers as $customer)
                <tr role="row" class="odd">
                  <td class="sorting_1">{{ $customer->username }}</td>
                  <td class="hidden-xs">{{ $customer->fullname }}</td>
                  <td class="hidden-xs">{{ $customer->email }}</td>
                  <td class="hidden-xs">{{ $customer->sex }}</td>
                  <td class="hidden-xs">{{ $customer->mobile }}</td>
                  <td class="hidden-xs">{{ $customer->address }} {{ $customer->province_name}}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('customer-management.destroy', ['id' => $customer->id]) }}" onsubmit = "return confirm('Bạn muốn xóa?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('customer-management.edit', ['id' => $customer->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin tooltip-left" data-tooltip="Sửa">
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
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <tr role="row">
                <!-- <th width="8%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Picture: activate to sort column descending" aria-sort="ascending">Picture</th> -->
                <th  class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label=UserName: activate to sort column descending" aria-sort="ascending">UserName</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="fullname: activate to sort column ascending">FullName</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Sex: activate to sort column ascending">Sex</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Mobile: activate to sort column ascending">Mobile</th>
                <th  class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Address</th>
                <th width="15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($customers)}} of {{count($customers)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $customers->links() }}
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
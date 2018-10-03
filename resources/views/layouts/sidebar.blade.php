  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("/asset/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ route('customer-management.index') }}"><i class="fa fa-table"></i> <span>Quản Lí Khách hàng</span></a></li>
        <li><a href="{{ url('order-bill')}}"><i class="fa fa-shopping-cart"></i> <span>Đơn hàng</span></a></li>
        
        <li><a href="{{ url('system-management/product') }}"><i class="fa fa-barcode"></i> <span> Sản Phẩm</span></a></li>
        <li><a href="{{ url('system-management/city') }}"><i class="fa fa-truck"> </i> Nhập kho</a></li>
        <li><a href="{{ url('system-management/report') }}"><i class="fa fa-list-alt"> </i> Tồn kho</a></li>
        <li><a href="{{ url('system-management/order') }}"><i class="fa fa-signal"> </i> Doanh số</a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Quản lý Sản phẩm</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('system-management/promotion') }}"><i class="fa fa-circle-o"></i> <span>Khuyễn mãi</span></a></li>
            <li><a href="{{ url('system-management/product-type') }}"><i class="fa fa-circle-o"> </i> Loại sản phẩm</a></li> 
          </ul>
        </li>
        <li><a href="{{ route('user-management.index') }}"><i class="fa fa-cogs"></i> <span>Quản lý người dùng</span></a></li>
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
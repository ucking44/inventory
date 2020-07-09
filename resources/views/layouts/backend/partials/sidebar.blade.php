<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('asset/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('asset/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ Request::is('home*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
          <li class="nav-item has-treeview {{ Request::is('master*') ? 'menu-open' : '' }}">
            {{-- <a href="#" class="nav-link {{ Request::is('master/vendor*') ? 'active' : '' }}"> --}}
                <a href="#" class="nav-link {{ Request::is('master*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('vendor.create') }}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Create Vendor</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('vendor.index') }}" class="nav-link active {{ Request::is('master/vendor*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Vendor</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.create') }}" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Create Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link {{ Request::is('master/product*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="./index3.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard v3</p>
                    </a>
                </li> --}}
            </ul>
          </li>
          {{-- <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> --}}
          <li class="nav-item has-treeview {{ Request::is('transaction*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('transaction*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Transaction
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('purchase-order.index') }}" class="nav-link {{ Request::is('transaction/purchase-order*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchase Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('sales.index') }}" class="nav-link {{ Request::is('transaction/sales*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('transaction/stock') }}" class="nav-link {{ Request::is('transaction/stock*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item has-treeview {{ Request::is('stock/report*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('stock/report*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('stock/report') }}" class="nav-link {{ Request::is('stock/report*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stock Reports</p>
                    </a>
                </li>
            </ul>
          </li>
        </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

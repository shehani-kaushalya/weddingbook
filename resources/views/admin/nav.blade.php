<div class="wrapper">

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Admin Information Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-th-large"></i>
      </a>

      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        <a href="{{ route('admin.logout') }}" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
          <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('admin.password_change') }}" class="dropdown-item">
          <i class="fas fa-key mr-2"></i> Change Password
          <!-- <span class="float-right text-muted text-sm">12 hours</span> -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('admin.profile') }}" class="dropdown-item">
        <i class="fas fa-user mr-2"></i> View Profile
          <!-- <span class="float-right text-muted text-sm">2 days</span> -->
        </a>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="WeddingBook" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Weddingbook MS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('admin/dist/img/blank-profile-picture.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <!-- <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="{{ (request()->routeIs('dashboard')) ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li> -->

        <li class="nav-item">
          <a href="{{ route('admin.vendors.list') }}" class="{{ (request()->routeIs('admin.vendors.*')) ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon fas fa-industry"></i>
            <p>Vendors</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.advetiesments') }}" class="{{ (request()->routeIs('admin.advetiesments')) ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon fas fa-image"></i>
            <p>Advetiesments</p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="{{ (request()->segment(2) == 'districts') ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>Locations<i class="right fas fa-angle-left"></i>
            </p>
          </a>
          
          <ul class="nav nav-treeview {{ (request()->segment(2) == 'districts') ? 'style="display: block;"' : '' }}">
            <li class="nav-item">
              <a href="{{route('districts.list')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Districts</p>
              </a>
            </li>
          </ul>

          <ul class="nav nav-treeview {{ (request()->segment(2) == 'cities') ? 'style="display: block;"' : '' }}">
            <li class="nav-item">
              <a href="{{route('city.list')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Cities </p>
              </a>
            </li>
          </ul>
        </li>
        
        <li class="nav-item">
          <a href="{{ route('users.list') }}" class="{{ (request()->segment(2) == 'users') ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Users</p>
          </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Image Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('sliders')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sliders</p>
                </a>
              </li>

              <!-- <li class="nav-item">
                <a href="{{route('advetiesment')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advertiesment  </p>
                </a>
              </li> -->
            </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.payments.list') }}" class="{{ (request()->routeIs('admin.payments.*')) ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon fas fa-money-bill-alt"></i>
            <p>Payments</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

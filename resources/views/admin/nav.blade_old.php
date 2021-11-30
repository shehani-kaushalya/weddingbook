<div class="wrapper">

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li>
  </ul>

  <!-- SEARCH FORM -->
  <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="{{asset('admin/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Brad Diesel
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">Call me whenever you can...</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="{{asset('admin/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                John Pierce
                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">I got your message bro</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="{{asset('admin/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Nora Silvester
                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm">The subject goes here</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
      </div>
    </li>
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 new messages
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 friend requests
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 new reports
          <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>


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
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> Change Password
          <!-- <span class="float-right text-muted text-sm">12 hours</span> -->
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
        <i class="fas fa-unlock-alt mr-2"></i> View Profile
          <!-- <span class="float-right text-muted text-sm">2 days</span> -->
        </a>
      </div>
    </li>

    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        <i class="fas fa-th-large"></i>
      </a>
    </li> -->
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
        <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Session::get('user_name') }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="{{ route('dashboard') }}" class="{{ (request()->segment(2) == 'dashboard') ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('users.list') }}" class="{{ (request()->segment(2) == 'users') ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              User List
            </p>
          </a>
        </li>



        {{-- <li class="nav-item">
          <a href="{{ route('customers') }}" class="{{ (request()->segment(2) == 'customers') ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              Customers List
            </p>
          </a>
        </li> --}}

        <li class="nav-item has-treeview">
          <a href="#" class="{{ (request()->segment(2) == 'customers') ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
                Customers
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview {{ (request()->segment(2) == 'customers') ? 'style="display: block;"' : '' }}">
            <li class="nav-item">
              <a href="{{route('customers.add')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>New Customers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('customers') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Customers List </p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="{{ route('suppliers.deactive') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Deactive Suppliers</p>
              </a>
            </li>       --}}
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="{{ (request()->segment(2) == 'staff') ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
                Staff
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview {{ (request()->segment(2) == 'staff') ? 'style="display: block;"' : '' }}">
            <li class="nav-item">
              <a href="{{route('staff.add')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>New Staff Member</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('staff')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Staff Members List </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('staff.deactive')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Deactive Members</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="{{ (request()->segment(2) == 'pages') ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
                Pages
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview {{ (request()->segment(2) == 'pages') ? 'style="display: block;"' : '' }}">
            <li class="nav-item">
              <a href="{{route('pages.category.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>New Categroy</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('pages.category.list')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Categroy</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview {{ (request()->segment(2) == 'pages') ? 'style="display: block;"' : '' }}">
            <li class="nav-item">
              <a href="{{route('pages.page.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('pages')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Pages </p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item has-treeview">
          <a href="#" class="{{ (request()->segment(2) == 'districts') ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
                Districts
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview {{ (request()->segment(2) == 'districts') ? 'style="display: block;"' : '' }}">
            <li class="nav-item">
              <a href="{{route('districts.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>New Districts</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('districts.list')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Districts</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview {{ (request()->segment(2) == 'cities') ? 'style="display: block;"' : '' }}">
            <li class="nav-item">
              <a href="{{route('city.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create City</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('city.list')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List Cities </p>
              </a>
            </li>
          </ul>
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
              <li class="nav-item">
                <a href="{{route('advetiesment')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advertiesment  </p>
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

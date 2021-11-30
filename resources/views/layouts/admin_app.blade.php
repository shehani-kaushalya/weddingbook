@include('admin.partials.header')
@include('admin.partials.admin_css')
@include('admin.nav')


@yield('content')

@include('admin.partials.admin_js')
@include('admin.partials.footer')
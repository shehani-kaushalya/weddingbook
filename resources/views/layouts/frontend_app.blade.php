@include('frontend.partials.header')
@include('frontend.partials.frontend_css')
@include('frontend.nav')


@yield('content')

@include('frontend.partials.frontend_js')
@include('frontend.partials.footer')

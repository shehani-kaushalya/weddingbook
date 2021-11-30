<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Amax.lk</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Bootstrap eCommerce Template">
    <meta name="author" content="SW-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('customer/assets/images/icons/favicon.ico')}}">

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('customer/assets/css/bootstrap.min.css')}}">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('customer/assets/css/style.min.css')}}">
    <link rel="stylesheet" href="{{asset('customer/assets/css/custom.css')}}">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">--}}

    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    @section('custom_css')
    @show
</head>
<body>

<div class="page-wrapper">


    <header class="header d-print-none">
        <div class="header-top">
            <div class="container">
                <div class="header-left header-dropdowns">

                    {{----}}
                    {{--<div class="header-dropdown">--}}
                        {{--<a href="#">USD</a>--}}
                        {{--<div class="header-menu">--}}
                            {{--<ul>--}}
                                {{--<li><a href="#">EUR</a></li>--}}
                                {{--<li><a href="#">USD</a></li>--}}
                            {{--</ul>--}}
                        {{--</div><!-- End .header-menu -->--}}
                    {{--</div><!-- End .header-dropown -->--}}

                    {{--<div class="header-dropdown">--}}
                        {{--<a href="#"><img src="{{asset('customer/assets/images/flags/en.png')}}" alt="England flag">ENGLISH</a>--}}
                        {{--<div class="header-menu">--}}
                            {{--<ul>--}}
                                {{--<li><a href="#"><img src="{{asset('customer/assets/images/flags/en.png')}}" alt="England flag">ENGLISH</a></li>--}}
                                {{--<li><a href="#"><img src="{{asset('customer/assets/images/flags/fr.png')}}" alt="France flag">FRENCH</a></li>--}}
                            {{--</ul>--}}
                        {{--</div><!-- End .header-menu -->--}}
                    {{--</div><!-- End .header-dropown -->--}}

                    {{--<div class="dropdown compare-dropdown">--}}
                        {{--<a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">--}}
                            {{--<i class="icon-retweet"></i> Compare (2)--}}
                        {{--</a>--}}

                        {{--<div class="dropdown-menu" >--}}
                            {{--<div class="dropdownmenu-wrapper">--}}
                                {{--<ul class="compare-products">--}}
                                    {{--<li class="product">--}}
                                        {{--<a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>--}}
                                        {{--<h4 class="product-title"><a href="product.html">Lady White Top</a></h4>--}}
                                    {{--</li>--}}
                                    {{--<li class="product">--}}
                                        {{--<a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>--}}
                                        {{--<h4 class="product-title"><a href="product.html">Blue Women Shirt</a></h4>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}

                                {{--<div class="compare-actions">--}}
                                    {{--<a href="#" class="action-link">Clear All</a>--}}
                                    {{--<a href="#" class="btn btn-primary">Compare</a>--}}
                                {{--</div>--}}
                            {{--</div><!-- End .dropdownmenu-wrapper -->--}}
                        {{--</div><!-- End .dropdown-menu -->--}}
                    {{--</div><!-- End .dropdown -->--}}
                </div><!-- End .header-left -->

                <div class="header-right">
                    {{--<p class="welcome-msg">Default welcome msg! </p>--}}

                    <div class="header-dropdown dropdown-expanded">
                        <a href="#">Links</a>
                        <div class="header-menu">
                            <ul>
                                {{-- <li><a href="{{route('customer.account.get.all.tickets.view')}}">SUBMIT A TICKET </a></li> --}}
                                {{-- <li><a href="{{route('customer.dashboard.view')}}">MY ACCOUNT </a></li> --}}
                                @guest
                                <li><a href="{{route('login')}}">LOG IN</a></li>
                                <li><a href="{{route('register')}}">REGISTER</a></li>
                                @else
                                    <li><a href="">Welcome, {{\Illuminate\Support\Facades\Auth::user()->first_name}}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form></li>
                                @endguest

                            </ul>
                        </div><!-- End .header-menu -->
                    </div><!-- End .header-dropown -->
                </div><!-- End .header-right -->
            </div><!-- End .container -->
        </div><!-- End .header-top -->

        <div class="header-middle">
            <div class="container">
                <div class="header-left">
                    <a href="{{route('user.home')}}" class="logo">
                        <img src="{{asset('customer/assets/images/logo.svg')}}" alt="Amax Logo">
                        <p class="text-line">World best brands at your fingertips</p>

                    </a>
                </div><!-- End .header-left -->

                <div class="header-center">
                    {{--<div class="header-search">--}}
                        {{--<a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>--}}
                        {{--<form action="#" method="get">--}}
                            {{--<div class="header-search-wrapper">--}}
                                {{--<input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>--}}
                                {{--<div class="select-custom">--}}
                                    {{--<select id="cat" name="cat">--}}
                                        {{--<option value="">All Categories</option>--}}
                                        {{--<option value="4">Fashion</option>--}}
                                        {{--<option value="12">- Women</option>--}}
                                        {{--<option value="13">- Men</option>--}}
                                        {{--<option value="66">- Jewellery</option>--}}
                                        {{--<option value="67">- Kids Fashion</option>--}}
                                        {{--<option value="5">Electronics</option>--}}
                                        {{--<option value="21">- Smart TVs</option>--}}
                                        {{--<option value="22">- Cameras</option>--}}
                                        {{--<option value="63">- Games</option>--}}
                                        {{--<option value="7">Home &amp; Garden</option>--}}
                                        {{--<option value="11">Motors</option>--}}
                                        {{--<option value="31">- Cars and Trucks</option>--}}
                                        {{--<option value="32">- Motorcycles &amp; Powersports</option>--}}
                                        {{--<option value="33">- Parts &amp; Accessories</option>--}}
                                        {{--<option value="34">- Boats</option>--}}
                                        {{--<option value="57">- Auto Tools &amp; Supplies</option>--}}
                                    {{--</select>--}}
                                {{--</div><!-- End .select-custom -->--}}
                                {{--<button class="btn" type="submit"><i class="icon-magnifier"></i></button>--}}
                            {{--</div><!-- End .header-search-wrapper -->--}}
                        {{--</form>--}}
                    {{--</div>--}}
                    <!-- End .header-search -->
                </div><!-- End .headeer-center -->

                <div class="header-right">
                    <button class="mobile-menu-toggler" type="button">
                        <i class="icon-menu"></i>
                    </button>


                    <div class="header-contact header-email">
                        <span>Email us now</span>
                        <a href="tel:#"><strong>info@amax.lk</strong></a>
                    </div><!-- End .header-contact -->


                    <div class="header-contact">
                        <span>Call us now</span>
                        <a href="tel:#"><strong>+94 777 465 406</strong></a>
                    </div><!-- End .header-contact -->

                    <div class="dropdown cart-dropdown">
                        {{-- <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                            <span class="cart-count">{{\App\Services\CartService::getTotalCount()}}</span>
                        </a> --}}

                        <div class="dropdown-menu" >
                            <div class="dropdownmenu-wrapper">
                                <div class="dropdown-cart-header">
                                    {{-- <span>{{\App\Services\CartService::getTotalCount()}} Items</span> --}}

                                    {{-- <a href="{{route('user.cart')}}">View Cart</a> --}}
                                </div><!-- End .dropdown-cart-header -->
                                <?php /*
                                <div class="dropdown-cart-products">


                                    @foreach(\App\Services\CartService::getCart() as $product)

                                    <div class="product">
                                        <div class="product-details">
                                            <h4 class="product-title">
                                                <a href="#">{{$product->name}}</a>
                                            </h4>

                                            <span class="cart-product-info">
                                                    <span class="cart-product-qty">{{$product->quantity}}</span>
                                                    x Rs.{{number_format($product->price, 2)}}
                                                </span>
                                        </div><!-- End .product-details -->

                                        <figure class="product-image-container">
                                            <a href="" class="">

                                                @php
                                                        $img = \App\Services\UtilService::getProductImageById($product->id);
                                                        @endphp

                                                @if($img)

                                                    <img src="{{config('amax.s3_bucket_url')}}/{{$img}}" alt="product">
                                                    @else

                                                    <img src="{{asset('img/default-pro.jpg')}}"/>

                                                    @endif




                                            </a>
                                            <a href="{{route('user.cart.remove', ['id' => $product->id])}}" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                                        </figure>
                                    </div><!-- End .product -->

                                    @endforeach


                                </div><!-- End .cart-product -->
                                */ ?>
                                <div class="dropdown-cart-total">
                                    <span>Total</span>

                                    {{-- <span class="cart-total-price">Rs. {{\App\Services\CartService::getTotal()}}</span> --}}
                                </div><!-- End .dropdown-cart-total -->

                                <div class="dropdown-cart-action">
                                    {{-- <a href="{{route('user.cart')}}" class="btn btn-block">View Cart</a> --}}
                                </div><!-- End .dropdown-cart-total -->
                            </div><!-- End .dropdownmenu-wrapper -->
                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .dropdown -->

                    {{-- <a href="{{route('user.checkout')}}" class="btn btn-outline-primary btn-secure">Make secure payment</a> --}}


                </div><!-- End .header-right -->
            </div><!-- End .container -->
        </div><!-- End .header-middle -->

        <div class="header-bottom sticky-header">
            <div class="container">
                <nav class="main-nav d-print-none">
                    <ul class="menu sf-arrows">
                        <li class="active"><a href="{{route('user.home')}}">Home</a></li>
                        {{-- <li class=""><a href="{{route('aboutPage')}}">About us</a></li> --}}


                        <li class=""><a href="#" class="sf-with-ul">Our Services</a>
                            <ul style="display: none;">
                                {{-- <li class=""><a href="{{route('viewPage', ['slug' => 'direct-sales'])}}">Direct Sales</a></li> --}}
                                {{-- <li class=""><a href="{{route('viewPage', ['slug' => 'purchase-request'])}}">Purchase Request</a></li> --}}
                                {{-- <li class=""><a href="{{route('viewPage', ['slug' => 'delivery-request'])}}">Delivery Request</a></li> --}}
                            </ul>
                        </li>

                        <li class="float-right"><a href="#">Contact us</a></li>
                    </ul>
                </nav>
            </div><!-- End .header-bottom -->
        </div><!-- End .header-bottom -->
     {{--   <div class="container" style="padding-left: 0px;
    padding-top: 0.5em;
    padding-bottom: 0.5em;">
            <div class="alert alert-warning" role="alert" style="width: 100%; margin: 0">
                You haven't verify your account yet. please be kind enough to verify your account using your mobile or email
            </div>
        </div>--}}
    </header><!-- End .header -->

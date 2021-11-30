@extends('layouts.customer_app')
@section('custom_css')
    <style>
        .request-types h2{
            text-transform: uppercase;
            margin-bottom: 0;
        }
        .request-types label{
            text-transform: uppercase;
            margin-bottom: 0;
        }
        .request-types span{
            font-size: 0.8em;
        }
        .request-item{
            padding: 3em 5em;
            background-repeat: no-repeat;
            background-position: center;
        }
        .request-types a.btn{
            min-width: 132px;
            padding: 1.1rem 2rem;
            font-size: 1.3rem;
        }
        .dr{
            background:linear-gradient(0deg,rgba(133,213,243,0.1),rgba(133,213,243,0.1)),url("{{asset('img/dr-background-amax.png')}}");
            background-size: cover;
        }
        .pr{
            background:linear-gradient(0deg,rgba(0,0,0,0.1),rgba(0,0,0,0.1)),url("{{asset('img/pr-background-amax.png')}}");
            background-size: cover;
        }
        .direct{
            background:linear-gradient(0deg,rgba(217,245,246,0.4),rgba(217,245,246,0.4)),url("{{asset('img/direct-purchase-background.png')}}");
            background-size: cover;
        }
    </style>
@endsection
@section('contents')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.home')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">{{$cat->name}}</a></li>

                </ol>
            </div>
            <!-- End .container -->
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    {{--<div class="boxed-slider owl-carousel owl-carousel-lazy owl-theme owl-theme-light mb-2 owl-loaded owl-drag loaded">--}}
                        {{--<!-- End .home-slide -->--}}
                        {{--<!-- End .home-slide -->--}}
                        {{--<div class="owl-stage-outer">--}}
                            {{--<div class="owl-stage" style="transform: translate3d(-1740px, 0px, 0px); transition: all 0.25s ease 0s; width: 5220px;">--}}

                                {{--<div class="owl-item cloned" style="width: 870px;">--}}
                                    {{--<div class="category-slide">--}}
                                        {{--<div class="slide-bg owl-lazy" data-src="{{asset('customer/assets/images/banners/banner-2.jpg')}}" style="background-image: url({{asset('customer/assets/images/banners/banner-1.jpg')}}); opacity: 1;"></div>--}}
                                        {{--<!-- End .slide-bg -->--}}
                                        {{--<div class="banner boxed-slide-content offset-1">--}}

                                            {{--<h1 class="banner-title">--}}
                                               {{--{{$cat->name}}--}}
                                            {{--</h1>--}}
                                            {{--<a href="#" class="btn btn-dark">Shop Now</a>--}}
                                        {{--</div>--}}
                                        {{--<!-- End .home-slide-content -->--}}
                                    {{--</div>--}}
                                {{--</div>--}}


                            {{--</div>--}}
                        {{--</div>--}}


                    {{--</div>--}}
                    <!-- End .home-slider -->
                    <div class="row row-sm">



                        @foreach($products as $product)


                        <div class="col-6 col-md-4" style="margin-bottom: 20px">
                            <div class="product-default">
                                <figure>

                                    @if($product->img)

                                        <a href="{{route('user.list.single', ['id' =>$product->id ])}}">
                                            <img src="{{config('amax.s3_bucket_url')}}/{{$product->img}}">
                                        </a>

                                    @else

                                        <a href="{{route('user.list.single', ['id' =>$product->id ])}}">
                                            <img src="{{asset('img/default-pro.jpg')}}" alt="product">
                                        </a>

                                    @endif


                                </figure>
                                <div class="product-details">
                                    <!-- End .product-container -->
                                    <h2 class="product-title">
                                        <a href="{{route('user.list.single', ['id' =>$product->id ])}}">{{$product->name}}</a>
                                    </h2>

                                    <!-- End .price-box -->
                                    <div class="product-action">


                                        <a href="{{route('user.list.single', ['id' =>$product->id ])}}" class="paction add-cart" title="Add to Cart">
                                            <span>View</span>
                                        </a>

                                    </div>
                                </div>
                                <!-- End .product-details -->
                            </div>
                        </div>

                        @endforeach


                    </div>
                    {{--
                    <nav class="toolbox toolbox-pagination">
                       --}}
                    {{--
                    <div class="toolbox-item toolbox-show">--}}
                    {{--<label>Showing 1–9 of 60 results</label>--}}
                    {{--
                 </div>
                 <!-- End .toolbox-item -->--}}
                    {{--
                    <ul class="pagination">
                       --}}
                    {{--
                    <li class="page-item disabled">--}}
                    {{--<a class="page-link page-link-btn" href="#"><i class="icon-angle-left"></i></a>--}}
                    {{--
                 </li>
                 --}}
                    {{--
                    <li class="page-item active">--}}
                    {{--<a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>--}}
                    {{--
                 </li>
                 --}}
                    {{--
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    --}}
                    {{--
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    --}}
                    {{--
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    --}}
                    {{--
                    <li class="page-item"><span>...</span></li>
                    --}}
                    {{--
                    <li class="page-item"><a class="page-link" href="#">15</a></li>
                    --}}
                    {{--
                    <li class="page-item">--}}
                    {{--<a class="page-link page-link-btn" href="#"><i class="icon-angle-right"></i></a>--}}
                    {{--
                 </li>
                 --}}
                    {{--
                 </ul>
                 --}}
                    {{--
                 </nav>
                 --}}
                </div>
                <!-- End .col-lg-9 -->
                <aside class="sidebar-shop col-lg-3 order-lg-first">
                    <div class="pin-wrapper" style="height: 1569.72px;">
                        <div class="sidebar-wrapper" style="border-bottom: 0px none rgb(122, 125, 130); width: 270px;">
                            <div class="widget">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-body-1" role="button" aria-expanded="true" aria-controls="widget-body-1">Categories</a>
                                </h3>
                                <div class="collapse show" id="widget-body-1">
                                    <div class="widget-body">
                                        <ul class="cat-list">
                                            @foreach(\App\ProductCategory::whereNull('parent_id')->get() as $pcat)
                                                <li><a href="{{route('singleCat', ['id' =>$pcat->slug])}}"><i class="{{$pcat->icon}}"></i> {{$pcat->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- End .widget-body -->
                                </div>
                                <!-- End .collapse -->
                            </div>
                            <!-- End .widget -->
                            <!-- End .widget -->
                        </div>
                    </div>
                    <!-- End .sidebar-wrapper -->
                </aside>
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
    </main>
    <!-- End .main -->
@endsection
@section('custom_js')
    <script>
        window.close();
        window.onunload = refreshParent;
        function refreshParent() {
            window.opener.test();
        }
    </script>
@endsection
@extends('layouts.customer_app')
@section('custom_css')
    <style>

    </style>
@endsection
@section('contents')
    <main class="main">

        <div class="page-header page-header-bg" style="background-image: url('{{asset('assets/images/pages/aboutus.jpg')}}');">
            <div class="container">
                <h1 style="color: #fff"><span style="color: #fff">IT'S ALL ABOUT</span>
                    AMAX EXPRESS</h1>
                {{--<a href="" class="btn btn-dark">Contact</a>--}}
            </div><!-- End .container -->
        </div>


        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.home')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="about-section">
            <div class="container">
                <h2 class="subtitle">OUR STORY</h2>
                <p>Amax is a true Sri Lankan company connecting the two words of Europe and Asia through a goods delivery superhighway. With 100% Sri Lankan ownership in both Sri Lanka and the United Kingdom, Amax is trying to address some of the issues Sri Lankan online buyers had for decades and open the doors to the quality European products market without paying a premium.</p>
                <p>We believe in the range of products available in a wide area actually can make life easier and increase the productivity of the nation. Lack of some of the basic equipment and gadgets in the Sri Lankan market hold back some of the most creative minds of our nation and often cheap alternatives affect the quality of the work done. Same time these low-quality alternatives eat up a lot of valuable foreign currency with their short span of life.</p>

                <p class="lead">“Amax Express (Pvt) Ltd registered in Sri Lanka as a private limited company with the registered office is in 85A, Fourth Floor, Dutugemunu Street, Kohuwala Sri Lanka. For handling and dispatching the goods from the United Kingdom, Amex Express Ltd registered in the company house at 109C, Kenton Road, Kenton, Harrow, HA3 0AN, the United Kingdom fulfilling the necessary condition under the Companies Act 2006.”</p>

                <p>We focus on quality and honest service understanding the importance of good customer experience all around for the growth of the company. Please pick us for your next order and enjoy the wonderful service offered by Amax.lk </p>
            </div><!-- End .container -->
        </div>

        <div class="features-section">
            <div class="container">
                <h2 class="subtitle">WHY CHOOSE US</h2>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="feature-box">
                            <i class="icon-shipped"></i>

                            <div class="feature-box-content">
                                <h3>Affordable Shipping</h3>
                                <p>Amax is a true Sri Lankan company connecting the two words of Europe and Asia through a goods delivery superhighway.</p>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-lg-4 -->

                    <div class="col-lg-4">
                        <div class="feature-box">
                            <i class="icon-us-dollar"></i>

                            <div class="feature-box-content">
                                <h3>Quality Products</h3>
                                <p>We believe in the range of products available in a wide area actually can make life easier and increase the productivity of the nation.</p>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-lg-4 -->

                    <div class="col-lg-4">
                        <div class="feature-box">
                            <i class="icon-online-support"></i>

                            <div class="feature-box-content">
                                <h3>Online Support 24/7</h3>
                                <p>We focus on quality and honest service understanding the importance of good customer experience all around for the growth of the company.</p>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-lg-4 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div>


    </main><!-- End .main -->
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


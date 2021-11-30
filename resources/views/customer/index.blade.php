@extends('layouts.frontend_app')
@section('custom_css')
<style>
    * {
        box-sizing: border-box
    }

    /* Slideshow container */
    .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
    }

    /* Hide the images by default */
    .mySlides {
        display: none;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -22px;
        padding: 16px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Caption text */
    .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active,
    .dot:hover {
        background-color: #717171;
    }

    /* Fading animation */
    .fade {
        -webkit-animation-name: fade !important;
        -webkit-animation-duration: 1.5s;
        animation-name: fade !important;
        animation-duration: 1.5s;
    }

    @-webkit-keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }
</style>
@stop

@section('content')

<body class="page">
    <main class="page__wrapper">
        <!------------------------------------------District Panel---------------------------------------------------------->
        <div class="page__wrapper-column">
            @include('customer.partials.region-group', ['districts' => $districts])
        </div>
        <!----------------------------------------End District Panel---------------------------------------------------------->
        <div class="page__wrapper-column">
            <div class="main-content">
                <div class="main-content-column">
                    <!------------------------------------------Slide Show---------------------------------------------------------->
                    <!-- Slideshow container -->
                    <div class="slideshow-container">
                        <!-- Full-width images with number and caption text -->
                        @foreach($slides as $key => $slide)
                            <div class="mySlides fade">
                                <div class="numbertext">&nbsp;</div>
                                <img src="{{ config('app.asset_url') }}/sliders/{{$slide['image']}}" style="width:100%">
                                <div class="text">{{$slide['title']}}</div>
                            </div>

                            @if($key+1 == count($slides))
                                <!-- Next and previous buttons -->
                                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                                <br />
                            @endif
                        @endforeach
                    </div>
                    <!------------------------------------------ End Slide Show---------------------------------------------------------->
                    <!-- The dots/circles -->
                    <div style="text-align:center">
                        @foreach($slides as $key => $slide)
                            <span class="dot" onclick="currentSlide({{$key}})"></span>
                        @endforeach
                    </div>
                    <!-- End The dots/circles -->
                    
                    <label for="tab-1" class="tab-label mt-2 t3 u-mt"  style= "text-align:center ;border-radius:5px ; height: 40px ;font-size: 20px; color:#040301 ; background-color: #f4c5d4" >My Wedding Book</label>

                    <span>
                        WE HELP YOU TO CREATE AUTHENTIC CELEBRATIONS AND GLAMOROUS GATHERINGS THAT FEEL JUST LIKE HOME. OUR GOAL IS FOR YOU TO FEEL SUPPORTED, INSPIRED AND HAPPY THROUGHOUT THE SELECTION PROCESS, SO YOU CAN ENJOY EVERY MOMENT.
                    </span>

                    <label for="tab-1" class="tab-label mt-3 t3 u-mt"  
                           style= "text-align:center ;border-radius:5px ; height: 40px ;font-size: 18px; color:#040301 ; background-color: #f4c5d4" >
                        Meet your vendor</label>

                    <div class="service-card-main u-mt1">
                        @foreach ($vendors as $vendor)
                            {{-- {{$vendor->vendorAddress}} --}}
                            <div class="service-card">
                                <a class="c-card" href="{{route('profile', $vendor->vendorAddress)}}">
                                    <div class="service-card__slider">
                                        <img src="{{ asset('vendor/'. $vendor->vendorAddress->biz_logo) }}" alt="{{ $vendor->vendorAddress ?? '' }}">
                                        {{-- <img src="{{ asset('frontend/images')}}/lassana-flora.png" alt="{{ $vendor->vendorAddress ?? '' }}"> --}}
                                        <h5>{{$vendor->vendorAddress->name}}</h5>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                   
                </div>
                 <!------------------------------------------Advertisment Panel---------------------------------------------------------->
                @include('customer.advetiesments', array('advetiesments' => \App\Advertisment::where('status', \App\Advertisment::ACTIVE)->get()))
            
            </div>
        </div>
    </main>
    @stop

    @section('custom_js')
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
                slides[i].className = slides[i].className.replace(" show", "");
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            slides[slideIndex-1].className += " show";

            dots[slideIndex-1].className += " active";
        }
    </script>
    @stop

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
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
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

<main class="page__wrapper">
    <div class="page__wrapper-column">
        @include('customer.partials.region-group', ['districts' => $districts])
    </div>

    <div class="page__wrapper-column">
        <div class="main-content">
            <!-- Vendor Categories : 1.Hotels  2.Photographers 3.Salon 4.Florist 5.Cakes and Cards ----------------------------------------------------->
            <div class="main-content-column">
                <div class="tabs-wrapper">
                    <div class="tabs">

                            <!-- 4.Florist ---------------------------------------------->
                        <div class="tab">
                            <input type="radio" name="css-tabs-ven" id="ven-tab-4" checked class="tab-switch">
                            <label for="ven-tab-4" class="tab-label">Florist</label>
                            
                            <div class="tab-content">
                                @foreach($vendors->where('biz_category', 1) as $profile)
                                    <div class="ven-box">
                                        <div class="ven-box__items">
                                            <a href="{{route('profile', $profile)}}" style="display: contents">
                                                <div class="ven-box__img"><img alt="" id="" src="{{ asset('vendor/'. $profile->biz_logo) }}">
                                                </div>
                                            </a>

                                            <div class="ven-box__txt">
                                                <span class="t5">{{$profile->name}}</span>
                                                <span class="t6">{{$profile->street_address}}</span>
                                                <span class="s7">{{$profile->telephone}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    
                        <!-- 1.Hotels --------------------------------------->
                        <div class="tab">
                            <input type="radio" name="css-tabs-ven" id="ven-tab-1"  class="tab-switch">
                            <label for="ven-tab-1" class="tab-label">Hotels</label>
                            
                            <div class="tab-content">
                                @foreach($vendors->where('biz_category', 2) as $profile)
                                    <div class="ven-box">
                                        <div class="ven-box__items">
                                            <a href="{{route('profile', $profile)}}" style="display: contents">
                                                <div class="ven-box__img"><img alt="" id="" src="{{ asset('vendor/'. $profile->biz_logo) }}">
                                                </div>
                                            </a>

                                            <div class="ven-box__txt">
                                                <span class="t5">{{$profile->name}}</span>
                                                <span class="t6">{{$profile->street_address}}</span>
                                                <span class="s7">{{$profile->telephone}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- 2.Photographers -------------------------------->
                        <div class="tab">
                            <input type="radio" name="css-tabs-ven" id="ven-tab-2" class="tab-switch">
                            <label for="ven-tab-2" class="tab-label">Photographers</label>

                            <div class="tab-content">
                                @foreach($vendors->where('biz_category', 3) as $profile)
                                    <div class="ven-box">
                                        <div class="ven-box__items">
                                            <a href="{{route('profile', $profile)}}" style="display: contents">
                                                <div class="ven-box__img"><img alt="" id="" src="{{ asset('vendor/'. $profile->biz_logo) }}">
                                                </div>
                                            </a>

                                            <div class="ven-box__txt">
                                                <span class="t5">{{$profile->name}}</span>
                                                <span class="t6">{{$profile->street_address}}</span>
                                                <span class="s7">{{$profile->telephone}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- 3.Salon -------------------------------------------->
                        <div class="tab">
                            <input type="radio" name="css-tabs-ven" id="ven-tab-3" class="tab-switch">
                            <label for="ven-tab-3" class="tab-label">Salon</label>
                            
                            <div class="tab-content">
                                @foreach($vendors->where('biz_category', 4) as $profile)
                                    <div class="ven-box">
                                        <div class="ven-box__items">
                                            <a href="{{route('profile', $profile)}}" style="display: contents">
                                                <div class="ven-box__img"><img alt="" id="" src="{{ asset('vendor/'. $profile->biz_logo) }}">
                                                </div>
                                            </a>

                                            <div class="ven-box__txt">
                                                <span class="t5">{{$profile->name}}</span>
                                                <span class="t6">{{$profile->street_address}}</span>
                                                <span class="s7">{{$profile->telephone}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                     
                        
                        <!-- 5.Cakes and Cards ------------------------------------------>
                        <div class="tab">
                            <input type="radio" name="css-tabs-ven" id="ven-tab-5" class="tab-switch">
                            <label for="ven-tab-5" class="tab-label">Cakes and Cards</label>
                            
                            <div class="tab-content">
                                @foreach($vendors->where('biz_category', 5) as $profile)
                                    <div class="ven-box">
                                        <div class="ven-box__items">
                                            <a href="{{route('profile', $profile)}}" style="display: contents">
                                                <div class="ven-box__img"><img alt="" id="" src="{{ asset('vendor/'. $profile->biz_logo) }}">
                                                </div>
                                            </a>

                                            <div class="ven-box__txt">
                                                <span class="t5">{{$profile->name}}</span>
                                                <span class="t6">{{$profile->street_address}}</span>
                                                <span class="s7">{{$profile->telephone}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        }
    </script>
@stop

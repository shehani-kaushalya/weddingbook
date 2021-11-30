
@extends('layouts.frontend_app')
@section('custom_css')
    <style>
        * {box-sizing:border-box}

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
.prev, .next {
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
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
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

.active, .dot:hover {
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
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}
    </style>
@stop


@section('content')

<body class="page">



<main class="page__wrapper">
    <div class="page__wrapper-column">
        @include('customer.partials.region-group', ['districts' => $districts])
    </div>

    <div class="page__wrapper-column">

        <div class="main-content">
            <div class="main-content-column">

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
                        </div>
                        <br />
                    @endif

                @endforeach

                <!-- The dots/circles -->

                <div style="text-align:center">
                    @foreach($slides as $key => $slide)
                        <span class="dot" onclick="currentSlide({{$key}})"></span>
                    @endforeach
                </div>






                <h2 class="t3 u-mt">Dashboard</h2>
                <span>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </span>
                <h3 class="t5 u-mt">Meet your Vendor</h3>



                <div class="service-card-main u-mt1">

                    <div class="service-card">
                        <a class="c-card" href="profile.html">
                            <div class="service-card__slider">
                                <img src="{{ asset('frontend/images')}}/lassana-flora.png">
                            </div>
                        </a>
                    </div>

                    <div class="service-card">
                        <a class="c-card" href="profile.html">
                            <div class="service-card__slider">
                                <img src="{{ asset('frontend/images')}}/vogue.jpg">
                            </div>
                        </a>
                    </div>

                     <div class="service-card">
                         <a class="c-card" href="profile.html">
                            <div class="service-card__slider">
                                <img src="{{ asset('frontend/images')}}/abisheka-mandapaya.jpg">
                            </div>
                         </a>
                    </div>


                    <div class="service-card">
                        <a class="c-card" href="profile.html">
                            <div class="service-card__slider">
                                <img src="https://image.wedmegood.com/resized-nw/400/images/MakeUpHairHome.jpg">
                            </div>
                        </a>
                    </div>


                </div>





            </div>



            <div class="main-content-column">
               <div class="tabs-wrapper">
                   <div class="tabs">
                       <div class="tab">
                           <input type="radio" name="css-tabs" id="tab-1" checked class="tab-switch">
                           <label for="tab-1" class="tab-label">Offers</label>
                           <div class="tab-content">


                            <div class="vendor-card">
                                <div class="vendor-card__slider">
                                    <div class="day-block">Handpicked</div>
                                    <img src="https://image.wedmegood.com/resized-nw/400/images/pages/home/fm-booking-dweb.jpg">
                                </div>
                                <div class="vendor-card__content">
                                    <div class="reviews-block">
                                        <span class="reviews-block__icon">*****</span>
                                        <span class="reviews-block__text">20 Reviews</span>
                                    </div>

                                    <div class="location-block">
                                        <span class="s5">Aira Wedding Planners</span>
                                        <span class="s7">Bangalore</span>
                                  </div>
                                </div>
                            </div>


                            <div class="vendor-card">
                                <div class="vendor-card__slider">
                                    <div class="day-block">Handpicked</div>
                                    <img src="https://image.wedmegood.com/resized/400X/uploads/vendor_cover_pic/45331/a68a20b1-9071-4508-aaa6-f6d42195a6df.png">
                                </div>

                                <div class="vendor-card__content">
                                    <div class="reviews-block">
                                        <span class="reviews-block__icon">*****</span>
                                        <span class="reviews-block__text">20 Reviews</span>
                                    </div>

                                    <div class="location-block">
                                        <span class="s5">Aira Wedding Planners</span>
                                        <span class="s7">Bangalore</span>
                                    </div>
                                </div>
                            </div>

                           </div>
                       </div>

                       <div class="tab">
                           <input type="radio" name="css-tabs" id="tab-2" class="tab-switch">
                           <label for="tab-2" class="tab-label">Discounts</label>
                           <div class="tab-content">Discount tab content</div>
                       </div>
                       <div class="tab">
                           <input type="radio" name="css-tabs" id="tab-3" class="tab-switch">
                           <label for="tab-3" class="tab-label">Coupon</label>
                           <div class="tab-content">Coupon tab content</div>
                       </div>

                   </div>
               </div>
            </div>


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


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
            
        <div class="main-content-column" style=" background-color:#f4c5d4">
            
        

        <h2 style="text-align:center" class="t3 u-mt"  ></h2>
                <span>
                <h1 style="text-align:center"> About Us</h1>
                <label for="tab-1" class="tab-label"  style=   "border-radius:5px ; height: 10px" ></label>
                   
                Finding perfect wedding vendors can be hard task since everyone is having different kind of perfection with their own selection. It’s good if there is one
platform to finding out Sri Lankan wedding vendors with their package details, photos & video gallery, promotions, offers and other information at one place.
<br>
This “WeddingBook” application do marketing & facilitate a specific platform for wedding vendors & customers. It gives one selection platform for people who
are planning their weddings. Anyone can discover all the Sri Lankan best wedding vendors at this site.<br>
<br>
Here,<br>
• Introducing virtual platform with the purpose of gathering all the vendor types into one place.<br>
• Providing information and different categories of one business selection platform for the people who are planning to marry<br>
• Reducing the time of vendors for replying user’s problems at social media groups.<br>
• Reducing the advertising cost of vendors.<br>
• Increasing the efficiency of vendors work.<br>
• Reducing time of customer when planning & organizing the wedding events.<br>
• Reducing the cost of couples when findings perfect vendors. (Ex: Reduce transport cost, other extra expenses, etc. )<br>
<br>
Shehani Kaushalya is an entrepreneur who likes to start own novel business. So, by considering this fields of problems she is planning to develop an online wedding platform
by answering the problems when people are finding a perfect wedding vendors.<br>

                </span>
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

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
    
    /* Style the tab */
    .tab {
      width: 100%;
      overflow: hidden;
      /*border: 1px solid #D8D8D8;*/
      background-color: transparent;
    }

    /* Style the buttons inside the tab */
    .tab button {
      background-color: transparent;
    }

    /* Change background color of buttons on hover */
    /*.tab button:hover {
      background-color: #ddd;
    }*/

    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #ccc;
    }
    .tab button:focus {
        outline: none;
    }

    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 0;
      /*border: 1px solid #ccc;*/
      /*border-top: none;*/
      padding-top: 50px
    }

    .unavailable, .unavailable > a, .unavailable > span {
        background-color: red !important;
        color: white !important;
        opacity: 0.9 !important;
    }

    .partially-available, .partially-available > a {
        background-color: orange !important;
        color: white !important;
        opacity: 0.9 !important;
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
            <div class="main-content-column">
                <div class="profile-box d-block">
                    <p>
                        {{ @$profile->_district->name }} 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>

                        {{ @$profile->_city->name }} 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                            
                        {{ $profile->_bizCategory->name }} 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                            
                        <span>{{ @$profile->name }}</span>
                    </p>

                    <div class="row">
                        <div class="col-12">
                            <div id="carousel-thumb" class="carousel slide carousel-thumbnails" data-ride="carousel">
                                <div class="carousel-inner" role="listbox">
                                    @foreach($profile->vendor_images as $key => $photos)
                                        @if($key == 0)
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="{{ asset('vendor/'.@$photos->image) }}" alt="{{ @$profile->name }}">
                                            </div>
                                        @else
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="{{ asset('vendor/'.@$photos->image) }}" alt="{{ @$photos->title }}" title="{{ @$photos->title }}" />
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>

                                <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>

                                <ol class="carousel-indicators list-inline mx-auto border py-3">
                                    @foreach($profile->vendor_images as $key => $photos)
                                        <li data-target="#carousel-thumb" 
                                            data-slide-to="{{$key}}" 
                                            class="list-inline-item {{ ($key == 0) ? 'active' : ''}}"> 
                                                <img class="img-fluid" 
                                                    src="{{ asset('vendor/'.@$photos->image) }}" 
                                                    title="{{ @$photos->title }}"
                                                    alt="{{ ($key == 0) ? @$profile->name : @$photos->title }}">
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-block">
                    <div class="tab">
                        <button class="chips-text s7 tablinks" onclick="opentab(event, 'aboutus')" id="defaultOpen">About Us</button>
                        <button class="chips-text s7 tablinks active" onclick="opentab(event, 'packages')">Packages</button>
                    </div>

                    <div id="aboutus" class="tabcontent">
                        <p class="text-justify">{{ $vendor->about }}</p>   
                    </div>

                    <div id="packages" class="tabcontent">
                        <p class="text-justify">{{ $packagesPromotion->package_description }}</p>
                    </div>
                </div>
            </div>

            <div class="main-content-column">
                <div class="profile-box-details">
                    <span><img class="profile-logo" alt="Profilek logo" id="" src="{{ asset('vendor/'. $profile->biz_logo) }}"></span>

                    <span class="t3">{{$profile->name ?? ''}}</span>

                    <span class="t6 u-mt">{{$profile->street_address ?? ''}}</span>

                    <span class="t7 u-mt1">
                        {{$profile->telephone ?? ''}}
                    </span>

                    <span class="u-mt text-justify">
                        {{$profile->message ?? ''}}
                    </span>

                    <div class="chip-wrapper u-mt">
                        <a class="button link-button-link" href="#check-availability">
                            <span class="link-button check-availability">Check Availability</span>
                        </a>
                        <!-- Modal begin -->
                        <div id="check-availability" class="overlay">
                            <div class="popup" style="margin: 20px auto;">
                                <h3 class="t3 u-mb">Check Availability</h3>
    
                                <div class="content">
                                    <div class="col-md-12">
                                        @if(Session::has('success_message'))
                                            <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                                {!! session('success_message') !!}
                                            </div>
                                        @endif
                                    </div>
                                    <form action="{{route('check-availability')}}" method="POST">
                                        @csrf
                                        <div class="two-col-box">
                                            <div class="two-col-box-items">
                                                <div class="input-field-wrap u-mb">
                                                    <label class="input-field-label" for="">Your Name *</label>
                                                    <input class="input-field" type="text" minlength="0" maxlength="" placeholder="Your Name" value="" name="name" required />
                                                    @if($errors->has('name')) <span class="invalid-feedback" style="display: block;" role="alert"> <strong>{{ $errors->first('name') }}</strong> </span> @endif
                                                </div>
        
                                                <div class="input-field-wrap u-mb">
                                                    <label class="input-field-label" for="">Telephone Number *</label>
                                                    <input class="input-field" type="text" minlength="0" maxlength="" placeholder="Telephone Number" value="" name="telephone" required />
                                                    @if($errors->has('telephone')) <span class="invalid-feedback" style="display: block;" role="alert"> <strong>{{ $errors->first('telephone') }}</strong> </span> @endif
                                                </div>
        
                                                <div class="input-field-wrap u-mb">
                                                    <label class="input-field-label" for="">Function Date *</label>
                                                    <input class="input-field" type="hidden" minlength="0" maxlength="" placeholder="Date" value="" name="date" required />
                                                    
                                                    <div id="datepicker"></div>
                                                    @if($errors->has('date')) <span class="invalid-feedback" style="display: block;" role="alert"> <strong>{{ $errors->first('date') }}</strong> </span> @endif
                                                </div>
                                            </div>
        
                                            <div class="two-col-box-items">
                                                <div class="input-field-wrap u-mb">
                                                    <label class="input-field-label" for="">Address</label>
                                                    <input class="input-field" type="text" minlength="0" maxlength="" placeholder="Address" value="" name="address" />
                                                    @if($errors->has('address')) <span class="invalid-feedback" style="display: block;" role="alert"> <strong>{{ $errors->first('address') }}</strong> </span> @endif
                                                </div>
        
                                                <div class="input-field-wrap u-mb">
                                                    <label class="input-field-label" for="">Email *</label>
                                                    <input class="input-field" type="email" minlength="0" maxlength="" placeholder="Email" value=""  name="email" required />
                                                    @if($errors->has('email')) <span class="invalid-feedback" style="display: block;" role="alert"> <strong>{{ $errors->first('email') }}</strong> </span> @endif
                                                </div>
        
                                                <div class="input-field-wrap u-mb">
                                                    <label class="input-field-label" for="">Time Duration *</label>
                                                    
                                                    <select class="input-field"  name="time" required>
                                                        <option value="" disabled selected="" hidden="">Select Time</option>
                                                        <option value="07:30 AM to 09:30 AM">07:30 AM to 09:30 AM</option>
                                                        <option value="10:30 AM to 04:00 PM">10:30 AM to 04:00 PM</option>
                                                        <option value="06:00 PM to 10:00 PM">06:00 PM to 10:00 PM</option>
                                                    </select>
                                                    @if($errors->has('time')) <span class="invalid-feedback" style="display: block;" role="alert"> <strong>{{ $errors->first('time') }}</strong> </span> @endif
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="vendor_id" value="{{$profile->cust_id ?? ''}}" />

                                        <div class="button-container">
                                            <a href="#" class="btn btn-default">Cancel</a> &nbsp;
                                            <button type="submit" class="input-button">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal end -->
                    </div>
                    
                    <div class="chip-wrapper u-mt">
                        <hr>
                    </div>

                    <div class="chip-wrapper u-mt">
                        <a class="chips-text s7" href="#write-review-modal">
                            <span class="write-review-modal">Write Review</span>
                        </a>
                        <!-- write-review-modal -->
                        <div id="write-review-modal" class="overlay">
                            <div class="popup">
                                <h3 class="t3 u-mb">Write your review</h3>

                                <div class="content">
                                    <div class="col">
                                        <form action="{{route('submit-review')}}" method="post">
                                            @csrf
                                            <div class="input-field-wrap u-mb">
                                                <label class="input-field-label" for="">Your Rating *</label>
                                                <div class="radio-button-wrap">
                                                    <label class="u-mr" style="font-weight:400"><input type="radio" style="margin-right: 5px;" name="rating" value="1" required /> 1 </label>
                                                    <label class="u-mr" style="font-weight:400"><input type="radio" style="margin-right: 5px;" name="rating" value="2" required /> 2 </label>
                                                    <label class="u-mr" style="font-weight:400"><input type="radio" style="margin-right: 5px;" name="rating" value="3" required /> 3 </label>
                                                    <label class="u-mr" style="font-weight:400"><input type="radio" style="margin-right: 5px;" name="rating" value="4" required /> 4 </label>
                                                    <label class="u-mr" style="font-weight:400"><input type="radio" style="margin-right: 5px;" name="rating" value="5" required /> 5 </label>
                                                </div>

                                            </div>
                                            <div class="input-field-wrap u-mb">
                                                <label class="input-field-label" for="">Your Review *</label>
                                                <textarea class="input-field" rows="5" minlength="0" maxlength="" placeholder="Your Review" name="review" required style="height: unset;"></textarea>
                                            </div>
                                            
                                            <input type="hidden" name="vendor_id" value="{{$profile->cust_id ?? ''}}" />

                                            <div class="button-container">
                                                <a href="#" class="btn btn-default">Cancel</a> &nbsp;
                                                <button type="submit" class="input-button">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="fb-root" style="display: none;"></div>
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId=2668112673514570&autoLogAppEvents=1" nonce="3bDW1PQK"></script>

                        <span class="fb-share-button" 
                              data-href="{{route('profile', $profile->cust_id)}}" 
                              data-layout="button_count" data-size="small">
                            <a target="_blank" 
                               href="" 
                               class="fb-xfbml-parse-ignore">Share</a>
                        </span>
                    </div>

                    <div class="chip-wrapper reviews u-mt">
                        <span class="reviews-txt t6">{{$reviews->count() ?? 0}} Reviews</span>
                    </div>

                    @foreach($reviews as $review)
                        <p class="s7 u-mt review-item">
                            <span class="reviews-icon">
                                @for ($i=0; $i < $review->rating; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#E56E94" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                @endfor
                            </span>
                            <br/>
                            {{$review->review}}
                        </p>
                    @endforeach
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

        if(slides[slideIndex-1]) {
            slides[slideIndex-1].style.display = "block";
        }

        if(dots[slideIndex-1]) {
            dots[slideIndex-1].className += " active";
        }
    }

    function opentab(evt, tabname) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabname).style.display = "block";
        evt.currentTarget.className += " active";
    }

    document.getElementById("defaultOpen").click();

    $( function() {
        $("#datepicker").datepicker({
            minDate: -0,
            dateFormat: 'yy-mm-dd',
            beforeShowDay: function(date){
                var schedules = JSON.parse('<?= $schedules ?>');

                var today = schedules.filter((schedule) => {
                    return new Date(schedule.date).setHours(0,0,0,0) == date.setHours(0,0,0,0)
                })
                // console.log('>>>>> ', today);
                if(today.length > 0) {
                    if(today[0].number_of_schedules == 3) { 
                        return [0, 'unavailable'];
                    }
                    else if(today[0].number_of_schedules > 0) {
                        return [1, 'partially-available'];
                    }
                }
                return [1];
            },
            onSelect: function (date, inst) {
                $('input[name="date"]').val(date);
                $.ajax({
                    type:"GET",
                    url:"{{url('get-date-availability')}}?vendor_id={{$profile->cust_id}}&date="+date,
                    success:function(res){
                        $('select[name="time"]').val('')
                        $('select[name="time"]').find('option').removeAttr('disabled');
                        if(res && res.length > 0) {
                            res.forEach((val) => {
                                $('select[name="time"]').find('option:contains("'+val+'")').prop('disabled', true);
                            })
                        }
                    }
                });
            }
        });
    });
</script>
@stop


@extends('layouts.frontend_app')
@section('custom_css')
<style>

    * { box-sizing:border-box; }

    /* Slideshow container for */
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

    #carousel-thumb .list-inline {
        white-space:nowrap;
        overflow-x:auto;
    }

    #carousel-thumb .carousel-indicators {
        position: static;
        left: initial;
        width: initial;
        margin-left: initial;
    }

    #carousel-thumb .carousel-indicators > li {
        width: 10%;
        height: initial;
        text-indent: initial;
    }

    #carousel-thumb .carousel-indicators > li.active img {
        opacity: 0.7;
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
/*    .tab button:hover {
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
</style>
@stop

@section('content')

<body class="page">

<main class="page__wrapper">
    <div class="page__wrapper-column">
        <!-- @include('frontend.vendor_nav_district') -->
    </div>

    <div class="page__wrapper-column">
        <div class="main-content">
            <div class="main-content-column pr-4">
                <div class="profile-box d-block">
                    <p>
                        {{ @$vendor_data['districts']->name }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>

                        {{ @$vendor_data['city']->name }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>

                        {{ $vendor_data['biz_category']->name }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>

                        <span>{{ @$vendor_data->name }}</span>
                    </p>

                    <div class="row">
                        <div class="col-12">
                            <div id="carousel-thumb" class="carousel slide carousel-thumbnails" data-ride="carousel">
                                <div class="carousel-inner" role="listbox">
                                    @foreach($vendor_data['photos'] as $key => $photos)
                                        @if($key == 0)
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="{{ asset('vendor/'.@$photos->image) }}" alt="{{ @$vendor_data->name }}">
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
                                    @foreach($vendor_data['photos'] as $key => $photos)
                                        <li data-target="#carousel-thumb" 
                                            data-slide-to="{{$key}}" 
                                            class="list-inline-item {{ ($key == 0) ? 'active' : ''}}"> 
                                                <img class="img-fluid" 
                                                    src="{{ asset('vendor/'.@$photos->image) }}" 
                                                    title="{{ @$photos->title }}"
                                                    alt="{{ ($key == 0) ? @$vendor_data->name : @$photos->title }}">
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-block">
                        <div class="tab">
                            <button class="chips-text s7 tablinks" onclick="opentab(event, 'aboutus')" id="defaultOpen">About Us</button>
                            <button class="chips-text s7 tablinks active" onclick="opentab(event, 'packages')">Packages</button>
                        </div>

                        <div id="aboutus" class="tabcontent">
                            <p class="text-justify">{{ $user_data->about ?? '' }}</p>   
                        </div>

                        <div id="packages" class="tabcontent">
                            <p class="text-justify">{{ $packages_promotion->package_description ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-column">
                <div class="profile-box-details">
                    <span>
                        @if(@$vendor_data->biz_logo != "")
                            <img id="profileImage" name="profileImage" class="profile-user-img img-fluid"
                            src="{{ config('app.asset_url') }}/vendor/{{ @$vendor_data->biz_logo }}" style="width:200px; height:200px"
                            alt="Profile picture" />
                        @else
                            <img id="profileImage" name="profileImage" class="profile-user-img img-fluid img-circle"
                            src="{{ config('app.asset_url') }}/admin/dist/img/blank-profile-picture.png" style="width:200px; height:200px"
                            alt="Profile picture" />
                        @endif
                    </span>

                    <span class="t3 u-mt">{{ @$vendor_data->name }}</span>

                    <span class="t6">{{ @$vendor_data->street_address }}</span>

                    <span class="t6">{{ @$vendor_data->telephone }}</span>

                    <span class="u-mt text-justify">
                        {{ @$vendor_data->message }}
                    </span>

                    <div class="main-content-wrapper u-mt">
                        <div class="box-modal">
                            <a class="button link-button-link" href="#popup1">
                                <span class="link-button check-availability">Check Availability</span>
                            </a>
                        </div>

                        <!-- Modal begin -->
                        <div id="popup1" class="overlay">
                            <div class="popup">
                                <h3 class="t3 u-mb">Check Availability</h3>

                                <div class="content">
                                    <div class="two-col-box">
                                        <div class="two-col-box-items">
                                            <div class="input-field-wrap u-mb">
                                                <label class="input-field-label" for="">Your Name *</label>
                                                <input class="input-field" type="text" minlength="0" maxlength="" placeholder="Your Name" value="" name="name" required />
                                            </div>
    
                                            <div class="input-field-wrap u-mb">
                                                <label class="input-field-label" for="">Telephone Number *</label>
                                                <input class="input-field" type="text" minlength="0" maxlength="" placeholder="Telephone Number" value="" name="telephone" required />
                                            </div>
    
                                            <div class="input-field-wrap u-mb">
                                                <label class="input-field-label" for="">Function Date *</label>
                                                <input class="input-field" type="date" minlength="0" maxlength="" placeholder="Date" value="" name="date" required />
                                            </div>
                                        </div>
    
                                        <div class="two-col-box-items">
                                            <div class="input-field-wrap u-mb">
                                                <label class="input-field-label" for="">Address</label>
                                                <input class="input-field" type="text" minlength="0" maxlength="" placeholder="Address" value="" name="address" />
                                            </div>
    
                                            <div class="input-field-wrap u-mb">
                                                <label class="input-field-label" for="">Email *</label>
                                                <input class="input-field" type="email" minlength="0" maxlength="" placeholder="Email" value=""  name="email" required />
                                            </div>
    
                                            <div class="input-field-wrap u-mb">
                                                <label class="input-field-label" for="">Time Duration *</label>
                                                
                                                <select class="input-field"  name="time" required>
                                                    <option value="" disabled selected="" hidden="">Select Time</option>
                                                    <option value="07:30 AM to 09:30 AM">07:30 AM to 09:30 AM</option>
                                                    <option value="10:30 AM to 04:00 PM">10:30 AM to 04:00 PM</option>
                                                    <option value="06:00 PM to 10:00 PM">06:00 PM to 10:00 PM</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="button-container">
                                        <a href="#" class="btn btn-default">Cancel</a> &nbsp;
                                        <button type="button" class="input-button" disabled>Submit</button>
                                    </div>
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
                                        <form action="#" onsubmit="return false;">
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
                                            
                                            <input type="hidden" name="vendor_id" value="{{$user_data->id ?? ''}}" />

                                            <div class="button-container">
                                                <a href="#" class="btn btn-default">Cancel</a> &nbsp;
                                                <button type="button" class="input-button">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="fb-root" style="display: none;"></div>
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId=2668112673514570&autoLogAppEvents=1" nonce="3bDW1PQK"></script>

                        <span class="fb-share-button" 
                              data-href="{{route('profile', $user_data->id)}}" 
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
    <script language="JavaScript">
        function showMyImage(fileInput) {
            var files = fileInput.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var imageType = /image.*/;
                if (!file.type.match(imageType)) {
                    continue;
                }
                var img=document.getElementById("profileImage");
                img.file = file;
                var reader = new FileReader();
                reader.onload = (function(aImg) {
                    return function(e) {
                        aImg.src = e.target.result;
                    };
                })(img);
                reader.readAsDataURL(file);
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
   </script>
@stop

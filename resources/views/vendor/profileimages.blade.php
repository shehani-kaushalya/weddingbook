@extends('layouts.frontend_app')
@section('custom_css')
    <style>
        * {
            box-sizing: border-box;
        }

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

<body class="page">

    <main class="page__wrapper">
        <div class="page__wrapper-column">
            @include('frontend.vendor_nav')
        </div>

        @if(@$user_data->verify_status != "2")
            <div class="page__wrapper-column">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page__wrapper-column">
                            <div class="main-content__one-column">
                                <div class="one-column__content-items">
                                    <div class="one-column__inner-row u-mt">
                                        <h2 class="t2 block-element u-mb3">Advertise your Buiness Profile</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        @if(Session::has('success_message'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                {!! session('success_message') !!}
                            </div>
                        @endif
                        @if(Session::has('error_message'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                {!! session('error_message') !!}
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <form method="POST" name="business_profile" id="business_profile" action="{{ route('profileimagesstore') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="page__wrapper-column">
                                <div class="main-content__one-column">
                                    <div class="one-column__content-items">
                                        <div class="single-row">
                                            <div class="input-field-wrap">
                                                <label class="input-field-label" for="">{{ __('Upload Photo Album') }}</label>
                                                <div class="profile-box profile-box-250 col-md-4 p-0 mb-2">
                                                    <img id="profileImage" name="profileImage" class="profile-user-img img-fluid img-circle m-0"
                                                         onclick="$('#inputFile').click();"
                                                         style="cursor: pointer;" 
                                                         src="{{ config('app.asset_url') }}/admin/dist/img/boxed-bg.jpg" style="width:100px; height:100px"
                                                         alt="Profile picture" />
                                                </div>
                                                
                                                @if($errors->has('upload')) <span class="invalid-feedback" style="display: block;" role="alert"> <strong>{{ $errors->first('upload') }}</strong> </span> @endif


                                                  <!--accept="image/*" -->
                                                   <!-- <input accept="audio/*,video/*,image/*" />-->
                                                   <!-- accept=".jpg, .jpeg, .png-->
                                                <input type="file" name="upload" class="custom-file-input" id="inputFile" style="display: none;" 
                                                    onchange="showMyImage(this)" required accept="image/*" />
                                            </div>
                                        </div>

                                        <div class="left-side-btn-wrap">
                                            <button class="link-button link-button--submit">Save Images</button>

                                            <input type="hidden" id="vendorId" name="vendorId" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" class="form-control" placeholder="id" />
                                            <input type="hidden" name="title" required value="Title : {{ @$vendor_image_data['title'] }}" id="title" class="form-control" placeholder="Title" />
                                            <input type="hidden" name="description" value="Description : {{ @$vendor_image_data['description'] }}" id="description" class="form-control" placeholder="Description" />
                                        </div>

                                        <p style="color: red"><small>* It is recommended to upload, <strong>min size: 200x200px</strong> images and <br>Limited to 08 images.</small></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6">
                        @if(count($vendor_data['photos']) > 0)
                            <div class="single-row">
                                <div class="input-field-wrap">
                                    <label class="input-field-label" for="">{{ __('Your Photos') }}</label>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            @if(count($vendor_data['photos']) > 0)
                                @foreach($vendor_data['photos'] as $key => $photos)
                                    <div class="col-sm-4 mb-3">
                                        <img id="profileImage" name="profileImage"
                                             class="profile-user-img img-fluid"
                                             src="{{ config('app.asset_url') }}/vendor/{{ @$photos->image }}"
                                             style="width: 100%;"
                                             alt="{{ @$photos->title }}"
                                             title="{{ @$photos->title }}"  />
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        @if(@$user_data->verify_status == "0")
                            <form method="POST" name="profile_review" id="profile_review" action="{{ route('profilereview') }}" enctype="multipart/form-data">
                                @csrf
                                @if(count($vendor_data['photos']) > 0)
                                    <div class="row" style="margin-top: 20px;">
                                        <button class="link-button link-button--submit u-mr is-disabled">Pay Now</button>
                                        <button class="link-button link-button--submit">Send for Review</button>
                                        <input type="hidden" id="vendorId" name="vendorId" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" class="form-control" placeholder="id" />
                                        <input type="hidden" id="review" name="review" value="2" class="form-control" placeholder="id" />
                                    </div>
                                @endif
                            </form>
                        @endif

                        @if(@$user_data->verify_status == "1")
                            <form method="POST" name="profile_review" id="profile_review" action="{{ route('profilereview') }}" enctype="multipart/form-data">
                                @csrf
                                @if(count($vendor_data['photos']) > 0)
                                    <div class="row" style="margin-top: 20px;">
                                        <a href="{{route('paynow')}}" class="link-button link-button--submit">Pay Now</a>
                                        <button class="link-button link-button--submit  u-mr is-disabled">Send for Review</button>
                                        <input type="hidden" id="vendorId" name="vendorId" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" class="form-control" placeholder="id" />
                                        <input type="hidden" id="review" name="review" value="2" class="form-control" placeholder="id" />
                                    </div>
                                @endif
                            </form>
                        @endif

                        @if(@$user_data->verify_status == "2")
                            <div class="row" style="margin-top: 20px; color:red;">
                                <div class="col-sm-12"> <h4>Your business profile approval process is pending... </h4></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="page__wrapper-column">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page__wrapper-column">
                            <div class="main-content__one-column">
                                <div class="one-column__content-items">
                                    <div class="one-column__inner-row u-mt">
                                        <h3 class="t5 block-element u-mb3">Please verify your account before continue. <a href="{{route('vendor_profile')}}">Go to Profile View</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
                    var img = document.getElementById("profileImage");
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
            //API-KEY : AIzaSyBaCI0EG_5EtDfr00Rdz4ceLYsaUjyoDlE
        </script>
    @stop

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
    </style>
@stop

@section('content')

<body class="page">

    <main class="page__wrapper">
        <div class="page__wrapper-column">
            @include('frontend.vendor_nav')
        </div>

        <form method="POST" name="business_profile" id="business_profile" action="{{ route('profilepromotionsstore') }}"  enctype="multipart/form-data">
            @csrf
            <div class="page__wrapper-column">
                <div class="row">
                    <div class="col-md-8">
                        <div class="page__wrapper-column">
                            <div class="main-content__one-column">
                                <div class="one-column__content-items">
                                    <div class="one-column__inner-row u-mt">
                                        <h2 class="t2 block-element u-mb3">Advertise your Buiness Profile</h2>
                                    </div>

                                    <div class="single-row">
                                        <div class="input-field-wrap">
                                            <label class="input-field-label" for="">{{ __('About Us') }}</label>
                                            <textarea class="input-field input-area @error('aboutus') is-invalid @enderror" id="aboutus" name="aboutus" type="text" cols="30" rows="4" placeholder="About Us" value="">{{ old('aboutus') ?? '' }}</textarea>
                                        </div>
                                        @error('aboutus') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                                    </div>

                                    <div class="single-row">
                                        <div class="input-field-wrap">
                                            <label class="input-field-label" for="">{{ __('Packages') }}</label>
                                            <textarea class="input-field input-area @error('packages') is-invalid @enderror" id="packages" name="packages" type="text" cols="30" rows="4" placeholder="Packages" value="">{{ old('packages') ?? '' }}</textarea>
                                        </div>
                                        @error('packages') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                                    </div>
                                </div>

                                <div class="left-side-btn-wrap u-mt4">
                                    <button class="link-button link-button--submit u-mr" id="btnSubmitCat">Save and Next</button>
                                    <input type="hidden" id="vendorId" name="vendorId" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" class="form-control" placeholder="id" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
    //API-KEY : AIzaSyBaCI0EG_5EtDfr00Rdz4ceLYsaUjyoDlE
</script>
@stop

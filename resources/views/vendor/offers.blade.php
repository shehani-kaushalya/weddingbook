
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

    <form method="POST" name="business_offers" id="business_offers" action="{{ route('offers') }}"  enctype="multipart/form-data">
        @csrf
        <div class="page__wrapper-column">
            <div class="row">
                <div class="col-md-6">
                    <div class="page__wrapper-column">
                        <div class="main-content__one-column">
                            <div class="one-column__content-items">
                                <div class="one-column__inner-row u-mt">
                                    <h2 class="t2 block-element u-mb3">Our Packages and Offers</h2>
                                </div>

                                <div class="one-column__inner-row">
                                    <div class="one-column__left-col">
                                        <div class="input-field-wrap">
                                            <label class="input-field-label" for="">Packages / Offer Name</label>
                                        </div>
                                    </div>

                                    <div class="one-column__right-col">
                                        <div class="input-field-wrap">
                                            <input class="input-field" required type="text" minlength="0" maxlength="" placeholder="Packages/Offer Name" name="package_name" value="{{ @$vender_data['name'] }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">Package Description</label>
                                    </div>
                                </div>
                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                        <textarea class="input-field input-area" id="packages_description" name="packages_description" type="text" cols="30" rows="4" placeholder="Packages" value="{{ @$vender_data['packages_description'] }}"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">Promotions</label>
                                    </div>
                                </div>
                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                        <textarea class="input-field input-area" id="promotions" name="promotions" type="text" cols="30" rows="4" placeholder="Promotions" value="{{ @$vender_data['promotions'] }}"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for=""> Package Price </label>
                                    </div>
                                </div>

                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                        <input class="input-field" required type="number" max="1000000.00" step="0.01" placeholder="Package Price " name="package_price" value="{{ @$vender_data['package_price'] }}" />
                                    </div>
                                </div>
                            </div>


                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for=""> Discounts </label>
                                    </div>
                                </div>

                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                        <input class="input-field" required type="number" min="0.00" max="100.00" step="0.01" minlength="0" maxlength="" placeholder="Enter % discount value" name="discounts" value="{{ @$vender_data['discounts'] }}" />
                                    </div>
                                </div>
                            </div>


                            <div class="left-side-btn-wrap u-mt4">
                                <button class="link-button link-button--submit u-mr">Save</button>
                                <button class="link-button link-button--submit">Cancel</button>
                                <input type="hidden" id="venderId" name="venderId" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" class="form-control" placeholder="id" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group row">&nbsp;</div>
                </div>
                <div class="col-md-5">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                @if(@$vender_data->biz_logo != "")
                                    <img id="profileImage" name="profileImage" class="profile-user-img img-fluid img-circle"
                                    src="{{ config('app.asset_url') }}/vender/{{ @$vender_data->biz_logo }}" style="width:100px; height:100px"
                                    alt="Profile picture" />
                                @else
                                    <img id="profileImage" name="profileImage" class="profile-user-img img-fluid img-circle"
                                    src="{{ config('app.asset_url') }}/admin/dist/img/avatar3.png" style="width:100px; height:100px"
                                    alt="Profile picture" />

                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="custom-file">
                                <input type="file" name="upload" class="custom-file-input" id="inputFile" onchange="showMyImage(this)" />
                                <label class="custom-file-label" for="inputFile">Choose file</label>
                            </div>
                        </div>
                        <label for="upload" class="col-sm-12 control-label">Upload Image</label>
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




   </script>



@stop

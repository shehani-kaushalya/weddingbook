
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

    <form method="POST" name="business_profile" id="business_profile" action="{{ route('profilebusinessstore') }}"  enctype="multipart/form-data">
        @csrf
        <div class="page__wrapper-column">
            <div class="page__wrapper-column">
            <div class="row">
                <div class="col-md-6">
                    <div class="page__wrapper-column">
                        <div class="main-content__one-column">
                            <div class="one-column__content-items">
                                <div class="one-column__inner-row u-mt">
                                    <h2 class="t2 block-element u-mb3">Advertise your own offers / Discounts</h2>
                                </div>

                                <div class="one-column__inner-row">
                                    <div class="one-column__left-col">
                                        <div class="input-field-wrap">
                                            <label class="input-field-label" for="">Name of your Business</label>
                                        </div>
                                    </div>

                                    <div class="one-column__right-col">
                                        <div class="input-field-wrap">
                                            <input class="input-field" required type="text" minlength="0" maxlength="" placeholder="Name of your Business" name="business_name" value="{{ @$vendor_data['name'] }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for=""> Contact Number </label>
                                    </div>
                                </div>

                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                        <input class="input-field" required type="text" minlength="0" maxlength="" placeholder="Contact Number" name="contact" value="{{ @$vendor_data['contact'] }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">Address</label>
                                    </div>
                                </div>

                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                        <input class="input-field" required type="text" minlength="0" maxlength="" placeholder="Address" name="address" value="{{ @$vendor_data['street_address'] }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">Message</label>
                                    </div>
                                </div>

                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                        <textarea class="input-field input-area" id="message" name="message" type="text" cols="30" rows="4" placeholder="Message" value="">{{ @$vendor_data['street_address3'] }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="left-side-btn-wrap u-mt4">
                                <button class="link-button link-button--submit u-mr">Save & Next</button>
                                <button class="link-button link-button--submit">Cancel</button>
                                <input type="hidden" id="vendorId" name="vendorId" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" class="form-control" placeholder="id" />
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
                            <div class="profile-box profile-box-250">
                                @if(@$vendor_data->biz_logo != "")
                                    <img id="profileImage" name="profileImage" class="profile-user-img img-fluid img-circle"
                                    src="{{ config('app.asset_url') }}/vendor/{{ @$vendor_data->biz_logo }}" style="width:100px; height:100px"
                                    alt="Profile picture" />
                                @else
                                    <img id="profileImage" name="profileImage" class="profile-user-img img-fluid img-circle"
                                    src="{{ config('app.asset_url') }}/admin/dist/img/blank-profile-picture.png" style="width:200px; height:200px"
                                    alt="Profile picture" />

                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="custom-file">
                                <input type="file" name="upload" required class="custom-file-input" id="inputFile" onchange="showMyImage(this)" accept="image/*"/>
                                <label class="custom-file-label" for="inputFile">Choose file</label>
                            </div>
                        </div>
                        <label for="upload" class="col-sm-12 control-label">Upload Image</label>
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


    $(function () {

        $('#cmbDistrict').on('change',function(){
            var districtID = $(this).val();
            if(districtID != 0){
                $.ajax({
                type:"GET",
                url:"{{url('get-city-list')}}?district_id="+districtID,
                success:function(res){
                        if(res){
                            $("#cmbCity").empty();
                            $("#cmbCity").append('<option value="0">Select City</option>');
                            $.each(res,function(key,value){
                                $("#cmbCity").append('<option value="'+key+'">'+value+'</option>');
                            });
                        }else{
                            $("#cmbCity").empty();
                        }
                    }
                });
            }else{
                $("#cmbCity").empty();
            }
        });

        var dist_id = "{{ @$vendor_data['biz_district'] }}" ;
        var city_id = "{{ @$vendor_data['biz_city'] }}" ;

        if(dist_id != "" && city_id != ""){
            // alert(dist_id + " : " + city_id);
            $.ajax({
                type:"GET",
                url:"{{url('get-city-list')}}?district_id="+dist_id,
                success:function(res){
                    if(res){
                        $("#cmbCity").empty();
                        $("#cmbCity").append('<option value="0">Select City</option>');
                        $.each(res,function(key,value){
                            if(key == city_id){
                                $("#cmbCity").append('<option selected value="'+key+'">'+value+'</option>');
                            }else{
                                $("#cmbCity").append('<option value="'+key+'">'+value+'</option>');
                            }

                        });
                    }else{
                    $("#cmbCity").empty();
                    }
                }
            });
        }


    });

    $("#btnSubmitCat").attr("disabled", true);

    $("[cate_data]").click(function () {

        var textCatVal = $(this).attr("cate_data");
        $('#cmbBusinessCategory').val(textCatVal);

        if(textCatVal > 0){
            $("#btnSubmitCat").attr("disabled", false);
        }else{
            $("#btnSubmitCat").attr("disabled", true);
        }
    });


    //API-KEY : AIzaSyBaCI0EG_5EtDfr00Rdz4ceLYsaUjyoDlE
   </script>



@stop

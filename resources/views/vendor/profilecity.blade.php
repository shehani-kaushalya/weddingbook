
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

    <form method="POST" name="business_profile" id="business_profile" action="{{ route('profilecitystore') }}"  enctype="multipart/form-data">
        @csrf
        <div class="page__wrapper-column">
            <div class="row">
                <div class="col-md-6">
                    <div class="page__wrapper-column">
                        <div class="main-content__one-column">
                            <div class="one-column__content-items">
                                <div class="one-column__inner-row u-mt">
                                    <h2 class="t2 block-element u-mb3"></h2>
                                </div>

                                <div class="region-group">
                                    <span class="t4 u-mb block-element">Select Your District & City</span>

                                    <div class="nestedsidemenu">
                                        <ul>
                                            @foreach($myDistricts as $key => $discity)
                                                <li>
                                                    <a href="javascript:void(0)"  dis_data_district="{{ $discity['id'] }}">{{ $discity['id'] }} - {{ $discity['name'] }} </a>
                                                    @if($discity['districts_cities_count'] > 0 )
                                                        <ul>
                                                            @foreach($discity['districts_cities'] as $key => $discitydata)
                                                                <li><a href="javascript:void(0)" dis_data_district_category="{{ $discitydata->district_id }}" dis_data_category="{{ $discitydata->id }}" >{{ $discitydata->name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="left-side-btn-wrap u-mt4">
                                <button class="link-button link-button--submit u-mr" id="btnSubmitCat">Save and Next</button>
                                
                                <input type="hidden" id="vendorId" name="vendorId" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" class="form-control" placeholder="id" />
                                <input type="hidden" id="cmbDistrict" name="cmbDistrict" value="" class="form-control" placeholder="District" />
                                <input type="hidden" id="cmbCity" name="cmbCity" value="" class="form-control" placeholder="Category" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group row">&nbsp;</div>
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
                    success:function(res) {
                        if(res) {
                            $("#cmbCity").empty();
                            $("#cmbCity").append('<option value="0">Select City</option>');
                            $.each(res,function(key,value){
                                $("#cmbCity").append('<option value="'+key+'">'+value+'</option>');
                            });
                        }
                        else {
                            $("#cmbCity").empty();
                        }
                    }
                });
            }
            else {
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
                            }
                            else {
                                $("#cmbCity").append('<option value="'+key+'">'+value+'</option>');
                            }
                        });
                    }
                    else {
                        $("#cmbCity").empty();
                    }
                }
            });
        }
    });

    $("#btnSubmitCat").attr("disabled", true);

    $("[dis_data_district]").click(function () {
        var textDistrictVal = $(this).attr("dis_data_district");
        $('#cmbDistrict').val(textDistrictVal);

        $(this).closest('li').siblings().find('a').css('background-color', '#fff');
        $(this).css('background-color', '#dccebb');

        if(textDistrictVal > 0) {
            $("#btnSubmitCat").attr("disabled", false);
        }
        else {
            $("#btnSubmitCat").attr("disabled", true);
        }
    });

    $("[dis_data_district_category]").click(function () {
        var textDistrictVal = $(this).attr("dis_data_district_category");
        $('#cmbDistrict').val(textDistrictVal);

        $(this).closest('li').siblings().find('a').css('background-color', '#fff');
        $(this).css('background-color', '#dccebb');

        $(this).closest('ul').parent('li').siblings().find('a').css('background-color', '#fff');
        $(this).closest('ul').parent('li').find('a[dis_data_district]').css('background-color', '#dccebb');

        var textCategoryVal = $(this).attr("dis_data_category");
        $('#cmbCity').val(textCategoryVal);

        if(textDistrictVal > 0) {
            $("#btnSubmitCat").attr("disabled", false);
        } 
        else {
            $("#btnSubmitCat").attr("disabled", true);
        }
    });

    //API-KEY : AIzaSyBaCI0EG_5EtDfr00Rdz4ceLYsaUjyoDlE
   </script>
@stop


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

    <form method="POST" name="pay_information" id="pay_information" action="{{ route('pay_compleet') }}"  enctype="multipart/form-data">
        @csrf
        <div class="page__wrapper-column">

        <div class="main-content__one-column">

            <div class="one-column__content-items">

                <div class="one-column__inner-row u-mt">
                    <h2 class="t2 block-element u-mb3">Card Information</h2>
                </div>

                <div class="one-column__inner-row">
                    <div class="two-col-box">
                        <div class="two-col-box-items">

                            <div class="input-field-wrap u-mb">
                                <label class="input-field-label" for="">Card Number</label>
                                <input class="input-field" type="text" required name="card_number" minlength="16" maxlength="16" placeholder="Card Number" value="">
                            </div>

                            <div class="input-field-wrap u-mb">
                                <label class="input-field-label" for="">Card expiry date</label>
                                <input class="input-field" type="text" name="card_expiry_date" required minlength="0" maxlength="" placeholder="MM/YYYY" value="">
                            </div>

                            <div class="input-field-wrap u-mb">
                                <label class="input-field-label" for="">Amount</label>
                                <input class="input-field" type="text" name="amount" required minlength="0" maxlength="" placeholder="Amount" value="">
                            </div>

                        </div>

                        <div class="two-col-box-items">

                            <div class="input-field-wrap u-mb">
                                <label class="input-field-label" for="">CVV</label>
                                <input class="input-field" type="text" name="cvv" required minlength="3" maxlength="4" placeholder="CVV" value="">
                            </div>

                            <div class="input-field-wrap u-mb">
                                <label class="input-field-label" for="">Name on Card</label>
                                <input class="input-field" type="text" name="name_on_card" required minlength="0" maxlength="" placeholder="Name on Card" value="">
                            </div>

                        </div>

                    </div>
                </div>

                <div class="left-side-btn-wrap u-mt4">

                    <button class="link-button link-button--submit">Next</button> &nbsp;
                    <input type="hidden" id="vendorId" name="vendorId" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" class="form-control" placeholder="id" />

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



    //API-KEY : AIzaSyBaCI0EG_5EtDfr00Rdz4ceLYsaUjyoDlE
   </script>



@stop

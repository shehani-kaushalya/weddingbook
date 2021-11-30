
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

    <form method="POST" target="_blank" name="payment_recipt" id="payment_recipt" action="{{ route('payment_recipt') }}"  enctype="multipart/form-data">
        @csrf
        <div class="page__wrapper-column">
            <div class="main-content__one-column">
                <div class="one-column__content-items">
                    <div class="one-column__inner-row u-mt">
                        <h2 class="t2 block-element u-mb3">Payment Successful</h2>
                    </div>

                    <div class="single-row-main">
                        <div class="single-row">
                        <label class="input-field-label s6-text" for="">Vendor Name</label>
                            <span class="s6-text"><b class="u-mr">:</b>{{ @$vendor_data['name'] }}</span>
                        </div>

                        {{-- <div class="single-row">
                        <label class="input-field-label s6-text" for="">Name of Card</label>
                            <span class="s6-text"><b class="u-mr">:</b>{{ @$payment_data['name_on_card']}}</span>
                        </div>

                        <div class="single-row">
                            <label class="input-field-label s6-text" for="">NIC Number</label>
                            <span class="s6-text"><b class="u-mr">:</b>{{ @$payment_data['nic']}}</span>
                        </div>

                        <div class="single-row">
                            <label class="input-field-label s6-text" for="">Telephone Number</label>
                            <span class="s6-text"><b class="u-mr">:</b>{{ @$payment_data['telephone']}}</span>
                        </div> --}}

                        {{-- <div class="single-row">
                            <label class="input-field-label s6-text" for="">Paymenty Type</label>
                            @if ($payment_data['pay_type'] == 'full')
                                <span class="s6-text"><b class="u-mr">:</b>Fully Payment</span>
                            @endif

                            @if ($payment_data['pay_type'] == 'partial')
                                <span class="s6-text"><b class="u-mr">:</b>Partial Payment</span>
                            @endif

                            @if ($payment_data['pay_type'] == 'advance')
                                <span class="s6-text"><b class="u-mr">:</b>Advance Payment</span>
                            @endif

                        </div> --}}

                        <div class="single-row">
                            <label class="input-field-label s6-text" for="">Amount</label>
                            <span class="s6-text"><b class="u-mr">:</b>{{ @$payment_data['amount'] }} {{ @$payment_data['currency'] }} </span>
                        </div>

                        <div class="single-row">
                            <label class="input-field-label s6-text" for="">Date</label>
                            <span class="s6-text"><b class="u-mr">:</b>{{  @$payment_data['created_at'] }}</span>
                        </div>
                    </div>

                    <div class="left-side-btn-wrap u-mt4">
                        <a href="{{ route('vendor_profile') }}" class="link-button-link u-mr"><span class="link-button link-button--submit">OK</span></a>
                        <button class="link-button link-button--submit">Save as PDF</button> &nbsp;
                        <input type="hidden" id="payment_id" name="payment_id" value="{{ request()->get('order_id') }}"/>
                        <input type="hidden" id="vendor_id" name="vendor_id" value="{{ auth()->user()->id }}"/>
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

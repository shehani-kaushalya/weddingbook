
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


        <div class="page__wrapper-column">
            <div class="row">
                <div class="col-md-6">
                    <div class="page__wrapper-column">
                        <div class="main-content__one-column">
                            <div class="one-column__content-items">
                                <div class="one-column__inner-row u-mt">
                                    <h2 class="t2 block-element u-mb3">Business Profile</h2>
                                </div>

                                <div class="one-column__inner-row">
                                    <div class="one-column__left-col">
                                        <div class="input-field-wrap">
                                            <label class="input-field-label" for="">Name of your Business</label>
                                        </div>
                                    </div>

                                    <div class="one-column__right-col">
                                        <div class="input-field-wrap">
                                            {{ @$vender_data->name }} 
                                        </div>
                                    </div>
                                </div>

                                <div class="one-column__inner-row">
                                    <div class="one-column__left-col">
                                        <div class="input-field-wrap">
                                            <label class="input-field-label" for="">Select Business Category</label>
                                        </div>
                                    </div>

                                    <div class="one-column__right-col">
                                        <div class="input-field-wrap">                                            
                                             {{ @$vender_data->biz_category }}                                        	 	
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="cmbDistrict">Your District</label>
                                    </div>
                                </div>

                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                        {{ @$vender_data->biz_district }} 
                                    </div>
                                </div>
                            </div>

                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">Your City</label>
                                    </div>
                                </div>

                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                         {{ @$vender_data->biz_city }} 
                                        
                                    </div>
                                </div>
                            </div>


                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">Address 1</label>
                                    </div>
                                </div>

                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                       {{ @$vender_data->street_address }} 
                                    </div>
                                </div>
                            </div>

                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">Address 2</label>
                                    </div>
                                </div>

                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                        {{ @$vender_data->street_address2 }}
                                    </div>
                                </div>
                            </div>

                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                    <label class="input-field-label" for="">Address 3</label>
                                    </div>
                                </div>

                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">                                       
                                        {{ @$vender_data->street_address3 }}
                                    </div>
                                </div>
                            </div>

                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">City</label>
                                    </div>
                                </div>

                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                        {{ @$vender_data->city }}
                                    </div>
                                </div>
                            </div>

                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for=""> State</label>
                                    </div>
                                </div>

                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                         {{ @$vender_data->state }}         
                                    </div>
                                </div>
                            </div>

                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">Postal code</label>
                                    </div>
                                </div>
                                

                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                         {{ @$vender_data->postal_code }}
                                    </div>
                                </div>
                            </div>

                            <div class="one-column__inner-row">
                                <div class="one-column__left-col">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">Zip Code</label>
                                    </div>
                                </div>

                                <div class="one-column__right-col">
                                    <div class="input-field-wrap">
                                         {{ @$vender_data->zip_code }}
                                    </div>
                                </div>
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
                                    src="{{ config('app.asset_url') }}/vender/{{ @$vender_data->biz_logo }}" style="width:50%;"  alt="Profile picture" />
                                @else
                                    <img id="profileImage" name="profileImage" class="profile-user-img img-fluid img-circle"
                                    src="{{ config('app.asset_url') }}/admin/dist/img/avatar3.png" style="width:100px; height:100px"
                                    alt="Profile picture" />

                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            Business Logo
                        </div>

                    </div>

                    
                </div>
            </div>
        </div>

</main>



@stop



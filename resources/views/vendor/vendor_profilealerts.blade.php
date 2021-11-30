
@extends('layouts.frontend_app')



@section('content')

<body class="page">
    <main class="page__wrapper">
        <div class="page__wrapper-column">
        </div>
        <div class="page__wrapper-column">
            {{-- @include('frontend.vendor_nav_district') --}}

            @php $amount = 1000.00; $currency = 'LKR'; @endphp
            @if($user_data->status == \App\User::APPROVED && in_array($user_data->verify_status, [\App\User::EMAIL_VERIFIED, \App\User::MOBILE_VERIFIED, \App\User::BOTH_VERIFIED]))
                <div class="u-mt block">
                    <p style="margin-bottom: 5px;">* Your account has been approved.!</p>
                    <p style="color: red;">Please proceed with the payment to complete your account activation.</p>

                    <form method="post" action="https://sandbox.payhere.lk/pay/checkout" id="paynow" class="d-none">   
                        <input type="hidden" name="merchant_id" value="1210941">    <!-- Replace your Merchant ID -->
                        <input type="hidden" name="return_url" value="{{ route('pay_successful') }}">
                        <input type="hidden" name="cancel_url" value="{{ route('vendor_profile') }}">
                        <input type="hidden" name="notify_url" value="{{ route('payhere.notify') }}">  
                        {{-- Item Details --}}
                        <input type="hidden" name="order_id" value="{{$user_data->id}}">
                        <input type="hidden" name="items" value="{{ @$vendor_data->name ?? $user_data->first_name. ' ' .$user_data->last_name}}"><br>
                        <input type="hidden" name="currency" value="{{ $currency }}">
                        <input type="hidden" name="amount" value="{{ $amount }}">  
                        {{-- Customer Details --}}
                        <input type="hidden" name="first_name" value="{{ $user_data->first_name }}">
                        <input type="hidden" name="last_name" value="{{ $user_data->last_name }}"><br>
                        <input type="hidden" name="email" value="{{ $user_data->email }}">
                        <input type="hidden" name="phone" value="{{ $user_data->phone }}"><br>
                        <input type="hidden" name="address" value="{{ $vendor_data->street_address }}">
                        <input type="hidden" name="city" value="{{ @$vendor_data['city']->name }}">
                        <input type="hidden" name="country" value="Sri Lanka">
                    </form> 

                    <div class="row">
                        <div class="col-3">
                            <a href="#" onclick="fnPayNow()" class="link-button-link"><span class="link-button link-button--submit">Pay Now</span></a>
                        </div>
                    </div>
                </div>
            @else
                @if($user_data->status !== \App\User::ACTIVE)
                    <div class="u-mt">
                        <p class="text-italic text-danger"><i>* Account is pending on approval/varification. Please check your emails to verify your account.</i></p>
                    </div>
                @endif
            @endif
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

    //API-KEY : AIzaSyBaCI0EG_5EtDfr00Rdz4ceLYsaUjyoDlE
    function fnPayNow() {
        // 
        $.ajax({
            url: "{{ route('vendor_paynow') }}",
            method: "POST", dataType: "JSON",
            data: { '_token': '{{ csrf_token() }}', 'cust_id': {{ $user_data->id }}, 'amount': {{ $amount }}, 'currency': '{{ $currency }}', 'description': 'vendor registration', 'payment_id': 'reg-{{ @$user_data->id }}' },
            success: function (response) {
                // console.log(response, '>>', response.id);
                if(response && response.payment_id) {
                    document.getElementsByName("order_id")[0].value = response.payment_id; //
                    document.getElementById('paynow').submit();
                }
            },
            error: function (error) {
                return false;
            }
        });
    };
   </script>



@stop

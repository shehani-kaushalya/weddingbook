
@extends('layouts.frontend_app')

@section('content')

<body class="page">
<main class="page__wrapper">
    <div class="page__wrapper-column">
    </div>

    <div class="page__wrapper-column">

        <div class="main-content__one-column">

            <div class="one-column__content-items">

                <div class="one-column__inner-row u-mt">
                    <h2 class="t2 block-element u-mb3">Advertise Your Own Offers / Discounts</h2>
                </div>

                <form action="{{ route('vendor_advertisment_post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="single-row">
                        <div class="input-field-wrap">
                            <label class="input-field-label" for="">{{ __('Advertisment Title') }}</label>
                            <input class="input-field @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? @$advertisment['title'] }}" required autocomplete="title" autofocus type="text" minlength="0" maxlength="" placeholder="Advertisment Title">
                        </div>
                        @error('title') <span class="invalid-feedback" style="display: block;" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>

                    <div class="single-row">
                        <div class="input-field-wrap">
                            <label class="input-field-label" for="">{{ __('Advertisment Content') }}</label>
                            <textarea class="input-field input-area @error('content') is-invalid @enderror" id="content" name="content" type="text" cols="30" rows="4" placeholder="Advertisment Content">{{ @$advertisment['content'] ?? '' }}</textarea>
                        </div>
                        @error('content') <span class="invalid-feedback" sty  le="display: block;" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>

                    <div class="single-row">
                        <div class="input-field-wrap">
                            <label class="input-field-label" for="">{{ __('Advertisment Post/Image') }}</label>
                            <div class="profile-box profile-box-250 col-md-5 p-0">
                                @if(@$advertisment['image'] != "")
                                    <img id="adImage" name="adImage" class="profile-user-img img-fluid img-circle"
                                         onclick="$('#inputFile').click();"
                                         style="cursor: pointer; margin-left: 0;" 
                                         src="{{ config('app.asset_url') }}/{{ @$advertisment['image'] }}" style="width:100px; height:100px"
                                         alt="Advertisment Post/Image" />
                                @else
                                    <img id="adImage" name="adImage" class="profile-user-img img-fluid img-circle"
                                         onclick="$('#inputFile').click();"
                                         style="cursor: pointer; margin-left: 0;" 
                                         src="{{ config('app.asset_url') }}/admin/dist/img/boxed-bg.jpg" style="width:200px; height:200px"
                                         alt="Profile picture" />
                                @endif
                                <input type="file" name="image" required class="custom-file-input" style="display: none;" id="inputFile" onchange="showMyImage(this)" accept="image/*"/>
                            </div>
                        </div>
                        @error('image') <span class="invalid-feedback" style="display: block;" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>
                    
                    <div class="left-side-btn-wrap u-mt4">
                        <button class="link-button link-button--submit u-mr" type="submit">Submit</button>
                        
                        @if($advertisment)
                            @if($advertisment->status == \App\Advertisment::ACTIVE) 
                                <button class="btn-success ink-button link-button--submit u-mr" type="button" disabled 
                                        style="pointer-events: none;">
                                    Published
                                </button>
                            @elseif($advertisment->status == \App\Advertisment::DE_ACTIVE) 
                                <button class="btn-danger link-button link-button--submit u-mr" type="button" disabled 
                                        style="pointer-events: none;">
                                    * Un-published or not approved!
                                </button>
                            @endif
                        @endif
                    </div>
                    
                    @if(!$advertisment or $advertisment->is_paid == 0)
                        <p style="margin-bottom: 0; margin-top: 10px; color: red;">
                            <small>There will be 2000/= charge (one time payment) for the advertisment before publish.</small>
                        </p> 
                    @endif

                </form>
                @if($advertisment)
                    <div class="left-side-btn-wrap u-mt4" style="display: block;">
                        @php $amount = 2000.00; $currency = 'LKR'; @endphp
                        @if($advertisment->is_paid == 0)
                            <p style="margin-bottom: 0;">Please proceed to payment for publish the advertisment.</p>
                            <form method="post" action="https://sandbox.payhere.lk/pay/checkout" id="paynow" onsubmit="fnPayNow()">      
                                <input type="hidden" name="merchant_id" value="1210941">
                                <input type="hidden" name="return_url" value="{{ route('pay_successful') }}">
                                <input type="hidden" name="cancel_url" value="{{ route('vendor_advertisments') }}">
                                <input type="hidden" name="notify_url" value="{{ route('payhere.notify') }}">  
                                {{-- Item Details --}}
                                <input type="hidden" name="order_id" value="ad-{{$advertisment->id}}">
                                <input type="hidden" name="items" value="{{ 'Vendor Advertisment Payment' }}">
                                <input type="hidden" name="currency" value="{{ $currency ?? 'LKR' }}">
                                <input type="hidden" name="amount" value="{{ $amount ?? 2000.00 }}">  
                                {{-- <br><br>Customer Details<br> --}}
                                <input type="hidden" name="first_name" value="{{ $user_data->first_name }}">
                                <input type="hidden" name="last_name" value="{{ $user_data->last_name }}">
                                <input type="hidden" name="email" value="{{ $user_data->email }}">
                                <input type="hidden" name="phone" value="{{ $user_data->phone }}">
                                <input type="hidden" name="address" value="{{ $vendor_data->street_address }}">
                                <input type="hidden" name="city" value="{{ @$vendor_data['city']->name }}">
                                <input type="hidden" name="country" value="Sri Lanka">

                                <button class="link-button link-button--submit" style="display: inline-flex;" type="submit">Proceed to Pay</button>
                            </form> 
                        @endif
                    </div>
                @endif
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
            var img=document.getElementById("adImage");
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
            data: { '_token': '{{ csrf_token() }}', 'cust_id': {{ $user_data->id }}, 'amount': {{ $amount ?? 2000.00 }}, 'currency': '{{ $currency ?? "LKR" }}', 'description': 'publish an advertisment', 'payment_id': 'ad-{{ @$advertisment->id }}' },
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

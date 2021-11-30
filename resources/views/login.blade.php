@extends('layouts.frontend_app')
@section('custom_css')
@stop


@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
    <br />
@endif

<main class="page__wrapper">
  <!--   <div class="page__wrapper-column">
        @include('customer.partials.region-group', ['districts' => $districts])
    </div>
 -->
     <div class="page__wrapper-column">
        @include('frontend.vendor_nav')
     </div>

    <div class="page__wrapper-column">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="main-content__one-column">
                    <div class="one-column__content-items">

                        <div class="one-column__inner-row u-mt">
                            <h2 class="t2 block-element u-mb3">User Registration</h2>
                        </div>

                         <form method="POST" name="register" id="register" action="{{ route('register') }}">
                            @csrf

                            <div class="single-row-main single-row-main--login">

                                <div class="single-row">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">First Name</label>
                                        <input class="input-field @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus type="text" minlength="3" maxlength="" placeholder="First Name">
                                    </div>
                                    @error('first_name') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                                </div>

                                <div class="single-row">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">Last Name</label>
                                        <input class="input-field @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus type="text" minlength="3" maxlength="" placeholder="Last Name">
                                    </div>
                                    @error('last_name') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                                </div>


                                <div class="single-row">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">{{ __('E-Mail Address') }}</label>
                                        <input class="input-field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus type="email" minlength="3" maxlength="" placeholder="Email Address">
                                    </div>
                                    @error('email') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                                </div>

                                <div class="single-row">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">{{ __('Password') }}</label>
                                        <input class="input-field @error('password') is-invalid @enderror" name="password" value="" required type="password" autofocus minlength="3" maxlength="" placeholder="Password">
                                    </div>
                                    @error('password') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                                </div>

                                <div class="single-row">
                                    <div class="input-field-wrap">
                                        <label class="input-field-label" for="">{{ __('Confirm Password') }}</label>
                                        <input class="input-field @error('password') is-invalid @enderror" name="password_confirmation" value="" required type="password" autofocus minlength="3" maxlength="" placeholder="Confirm Password">
                                    </div>
                                    @error('password_confirmation') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                                </div>

                                <div class="single-row">
                                    <div class="left-side-btn-wrap u-mt4">
                                        <button class="link-button link-button--submit u-mr" type="submit">Register</button>
                                        <input class="input-field" name="type_id" value="200" required autofocus type="hidden" />
                                    </div>
                                </div>
                            </div>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@stop

@section('custom_js')
@stop

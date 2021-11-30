@extends('layouts.frontend_app')
@section('custom_css')
@stop


@section('content')


<main class="page__wrapper">
    <div class="page__wrapper-column">

        <div class="region-group">
            <span class="t3">Districts</span>
            <ul class="region-group-locations">
                @foreach($districts as $key => $district)
                <li><a href="filter.html" class="">{{ $district['name'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="page__wrapper-column">


        <div class="row">
            <div class="col-sm-3 col-md-6" style="background-color:#f5f5f5;">

                <div class="container">
                    <div class="heading mb-4 ">
                        <h2 class="title">Register</h2>
                        <p>Please enter your details</p>
                    </div><!-- End .heading -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group required-field">
                            <label for="first_name">First Name</label>
                            <input id="first_name" type="text"
                                class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group required-field">
                            <label for="last_name">Last Name</label>
                            <input id="last_name" type="text"
                                class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group required-field">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group required-field">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group required-field">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                    <div class="social-login-wrapper">
                        <p>Access your account through your social networks.</p>
                        <div class="btn-group">
                            <a href="{{route('social.login',['google'])}}"
                                class="btn btn-social-login btn-md btn-gplus mb-1"><i
                                    class="icon-gplus"></i><span>Google</span></a>
                            <a href="{{route('social.login',['facebook'])}}"
                                class="btn btn-social-login btn-md btn-facebook mb-1"><i
                                    class="icon-facebook"></i><span>Facebook</span></a>
                            <a href="{{route('social.login',['twitter'])}}"
                                class="btn btn-social-login btn-md btn-twitter mb-1"><i
                                    class="icon-twitter"></i><span>Twitter</span></a>
                        </div>
                    </div>
                </div>
                <!-- End .container -->
            </div>
            <div class="col-sm-9 col-md-6" style="background-color:#dddddd;">

                <div class="container">
                    <div class="heading mb-4">
                        <h2 class="title">Login</h2>
                        <p>Please enter your email address and password to login</p>
                    </div><!-- End .heading -->

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>

                            <a class="btn btn-primary btn-flat" href="{{route('register')}}">Register</a>
                        </div>
                    </form>
                    <div class="social-login-wrapper">
                        <p>Access your account through your social networks.</p>

                        <div class="btn-group">
                            <a href="{{route('social.login', ['google'])}}"
                                class="btn btn-social-login btn-md btn-gplus mb-1"><i
                                    class="icon-gplus"></i><span>Google</span></a>
                            <a href="{{route('social.login', ['facebook'])}}"
                                class="btn btn-social-login btn-md btn-facebook mb-1"><i
                                    class="icon-facebook"></i><span>Facebook</span></a>
                            <a href="{{route('social.login', ['twitter'])}}"
                                class="btn btn-social-login btn-md btn-twitter mb-1"><i
                                    class="icon-twitter"></i><span>Twitter</span></a>
                        </div>
                    </div>
                </div><!-- End .container -->
            </div>

        </div>
    </div>
</main>



@stop


@section('custom_js')
@stop
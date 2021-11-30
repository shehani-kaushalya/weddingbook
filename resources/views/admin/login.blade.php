<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>wedding book Administration | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ config('app.asset_url') }}/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ config('app.asset_url') }}/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ config('app.asset_url') }}/admin/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<!-- @php var_dump($errors); @endphp -->
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>{{ __('Wedding Book') }}</b> {{ __('Administration') }} </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

        <p class="login-box-msg">{{ __('Sign in to start your session') }}</p>

        @if(Session::has('error_message'))
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Error!</h5>
            {!! session('error_message') !!}
          </div>
        @endif

        @if(Session::has('error_message_logout'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success!</h5>
            {!! session('error_message_logout') !!}
          </div>
        @endif

      <form action="{{ route('admin.login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
          <!--
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div> {{ $errors->login->first('email') }}
          -->

          <?php //print_r($errors); ?>
          <!--
          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
          -->
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" name="password" class="form-control" required placeholder="Password">
          <!--
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          -->
          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror

        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">{{ __('Remember Me') }}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Sign In') }}</button>

          </div>

          <!-- /.col -->
        </div>
      </form>
      <?php
      /*
      <!-- <div class="social-auth-links text-center mb-3">
        <p>- {{ __('OR') }} -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> {{ __('Sign in using Facebook') }}
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> {{ __('Sign in using Google+') }}
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="#">{{ __('I forgot my password') }}</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">{{ __('Register a new membership') }}</a>
      </p> -->

      */ ?>
    </div>
    <!-- /.login-card-body -->

  </div>
  <a href="{{ config('app.asset_url') }}">Weddingbook</a>
</div>

<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ config('app.asset_url') }}/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ config('app.asset_url') }}/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>


@section('custom_css')
<link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">


<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
<!-- Theme style -->
{{-- <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}}


@stop
@extends('layouts.admin_app')
@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Staff</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Staff</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Staff >> {{ @$staff_data['page'] }} </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                    @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            {!! session('success_message') !!}
                        </div>
                    @endif

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

                    <form name="user_data" id="user_data" method="post" action="{{ route('staff.edit') }}"  enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="firstName" class="col-sm-2 control-label">First Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="firstName" required value="{{ @$staff_data['first_name'] }}" id="firstName" class="form-control" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastName" class="col-sm-2 control-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="lastName" required value="{{ @$staff_data['last_name'] }}" id="lastName" class="form-control" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" id="email"  name="email" value="{{ @$staff_data['email'] }}" required class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="phone" name="phone" value="{{ @$staff_data['phone'] }}" class="form-control" placeholder="Phone">
                                        </div>
                                    </div>

                                    <!-- Date dd/mm/yyyy -->
                                    <div class="form-group row">
                                        <label for="dob" class="col-sm-2 control-label">Date of Birth</label>

                                        <div class="input-group col-sm-10">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" id="dob" name="dob" value="{{ @$staff_data['dob'] }}" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                    <div class="form-group row">
                                        <label for="status" class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-10">
                                            <select id="status" name="status" class="form-control select2" style="width: 100%;">
                                                <option value="100" selected="selected"> Active </option>
                                                <option value="10"> Inactive </option>
                                            </select>
                                        </div>
                                    </div>


                            </div>
                            <div class="col-md-4">

                                <div class="form-group row">
                                     <div class="col-sm-12">
                                        <div class="text-center">

                                        @if(@$staff_data['image'] != "")
                                            <img id="profileImage" name="profileImage" class="profile-user-img img-fluid img-circle"
                                            src="{{ config('app.asset_url') }}/staff/{{ @$staff_data['image'] }}" style="width:100px; height:100px"
                                            alt="Profile picture" />

                                        @else
                                            <img id="profileImage" name="profileImage" class="profile-user-img img-fluid img-circle"
                                            src="{{ config('app.asset_url') }}/admin/dist/img/avatar3.png" style="width:100px; height:100px"
                                            alt="Profile picture" />

                                        @endif
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="custom-file">
                                            <input type="file" name="upload" class="custom-file-input" id="inputFile" onchange="showMyImage(this)" accept="image/*">
                                            <label class="custom-file-label" for="inputFile">Choose file</label>
                                        </div>
                                    </div>
                                    <label for="upload" class="col-sm-12 control-label">Upload Image</label>
                                </div>
                            </div>
                        </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" id="id" name="id" value="{{ @$staff_data['id'] }}" class="form-control" placeholder="id" />
                            <input type="hidden" id="type" name="type" value="{{ \App\User::STAFF }}" class="form-control" placeholder="type" />

                            <button type="reset" class="btn btn-default float-right"> Cancel </button> &nbsp;&nbsp;
                            <button type="submit" class="btn btn-info float-right"> Submit </button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
                <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@stop


@section('custom_js')


<!-- Select2 -->
<script src="{{ config('app.asset_url') }}/admin/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ config('app.asset_url') }}/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="{{ config('app.asset_url') }}/admin/plugins/moment/moment.min.js"></script>
<script src="{{ config('app.asset_url') }}/admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>


<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })



    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()




  })

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

</script>

@stop




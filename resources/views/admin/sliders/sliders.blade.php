@extends('layouts.admin_app')

@section('custom_css')

 <!-- Font Awesome -->
 <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
 <!-- Ionicons -->
 <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 <!-- Theme style -->
 {{-- <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}"> --}}
 <!-- Google Font: Source Sans Pro -->
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<style>
/* .post .user-block{margin-bottom:15px; width:100%} */
</style>

@stop

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sliders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Home Slider</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sliders >> New Image </h3>
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
                    <br/>
                @endif

                <form name="sliders" id="sliders" method="post" action="{{ route('sliders.create') }}"  enctype="multipart/form-data">
                  @csrf
                      <div class="card-body">
                          <div class="row">
                              <div class="col-md-8">
                                  <div class="form-group row">
                                      <label for="firstName" class="col-sm-2 control-label">Title</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="title" required value="{{ @$user_data['title'] }}" id="title" class="form-control" placeholder="Title">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="lastName" class="col-sm-2 control-label">Description</label>
                                      <div class="col-sm-10">
                                          <textarea type="text" name="description" required value="" id="description" class="form-control" placeholder="Description">{{ @$user_data['description'] }}</textarea>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-8">
                                  <div class="form-group row">
                                      <label for="upload" class="col-sm-2 control-label">Upload Image</label>
                                      <div class="col-sm-10">
                                          <div class="custom-file">
                                              <input type="file" name="upload" required class="custom-file-input" id="inputFile" onchange="showMyImage(this)" accept="image/*">
                                              <label class="custom-file-label" for="inputFile">Choose file</label>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                          <input type="hidden" id="id" name="id" value="{{ @$user_data['id'] }}" class="form-control" placeholder="id" />
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

          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                          <!-- /.user-block -->
                          <div class="row mb-3">

                                @php
                                  $i = 1
                                @endphp
                                @foreach($sliders_data as $sliders)
                                  @if($i == 1)
                                      <div class="row"   style="margin-bottom:20px;">
                                        <img class="img-fluid" src=" {{ config('app.asset_url') }}/sliders/{{ $sliders->image }}" alt="{{ $sliders->title }}" />
                                        <span class="description" style="width: 100%;">{{ $sliders->title }} <br/></span>
                                        <span class="description" style="width: 100%;">
                                          {{ $sliders->description }} <br/>
                                        </span>
                                        <button class="btn btn-danger btn-sm" data-href="slider/{{ $sliders->id }}" data-toggle="modal" data-target="#slider-delete">
                                            Delete Slider
                                        </button>

                                      </div>
                                      <div class="row">
                                  @else
                                    <div class="col-sm-4" style="margin-bottom:20px;">
                                      <img class="img-fluid mb-3" src="{{ config('app.asset_url') }}/sliders/{{ $sliders->image }}" alt="{{ $sliders->title }}">
                                      <span class="description" style="width: 100%;">
                                        {{ $sliders->title }} <br/>
                                      </span>

                                      <span class="description" style="width: 100%;">
                                        {{ $sliders->description }} <br/>
                                      </span>

                                      <button class="btn btn-danger btn-sm" data-href="slider/{{ $sliders->id }}" data-toggle="modal" data-target="#slider-delete">
                                        Delete Slider
                                      </button>
                                      <br/>
                                    </div>
                                  @endif

                                  @php
                                  $i++
                                  @endphp

                                @endforeach
                                  </div>

                            {{-- <div class="col-sm-6">
                              <img class="img-fluid" src="{{ config('app.asset_url') }}/admin/dist/img/photo1.png" alt="Photo" />
                            </div> --}}
                            <!-- /.col -->
                            {{-- <div class="col-sm-6">

                              <div class="row">
                                <div class="col-sm-6">
                                  <img class="img-fluid mb-3" src="{{ config('app.asset_url') }}/admin/dist/img/photo2.png" alt="Photo">
                                  <img class="img-fluid mb-3" src="{{ config('app.asset_url') }}/admin/dist/img/photo3.jpg" alt="Photo">
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                  <img class="img-fluid mb-3" src="{{ config('app.asset_url') }}/admin/dist/img/photo4.jpg" alt="Photo">
                                  <img class="img-fluid mb-3" src="{{ config('app.asset_url') }}/admin/dist/img/photo1.png" alt="Photo">
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div> --}}
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- /.post -->
                      </div>
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
  <!-- /.content-wrapper -->


    <div class="modal fade" id="slider-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Sliders Management</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <p>Are you sure you want to delete this slider?</p>
              <p class="debug-url"></p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            <a href="" id="cmPrimary" class="btn bg-gradient-success btn-sm cmPrimary">Confirm Delete</a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



@stop



@section('custom_js')

<!-- jQuery -->
<script src="{{ config('app.asset_url') }}/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ config('app.asset_url') }}/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ config('app.asset_url') }}/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ config('app.asset_url') }}/admin/dist/js/demo.js"></script>

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



    $('#slider-delete').on('show.bs.modal', function(e) {
      $(this).find('.cmPrimary').attr('href', $(e.relatedTarget).data('href'));
    });

  </script>


@stop


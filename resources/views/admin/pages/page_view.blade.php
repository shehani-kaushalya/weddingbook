@extends('layouts.admin_app')

@section('custom_css')

 <!-- Font Awesome -->
 <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
 <!-- Ionicons -->
 <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

 <!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">


@stop

@section('content')

     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
              <h1>Page : {{ $pages_data['name']}}</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Page</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">

              <div class="col-md-12">
                <div class="card">

                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                          <p>
                              Slug : {{ $pages_data['slug']}}
                          </p>
                          <p>
                              {{ strip_tags($pages_data['body']) }}
                          </p>



                          <p>
                          @if(@$pages_data['featured_image'] != "")
                              <img id="profileImage" name="profileImage" class="img-fluid"
                              src="{{ config('app.asset_url') }}/pages/{{ @$pages_data['featured_image'] }}"
                              alt="Featured Image" />
                          @endif
                          </p>
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
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->



      <!-- /.modal -->
@stop



@section('custom_js')

<script>

  function assignURL(param){
    // alert("Bingo" + param);
    // var oldUrl = $(this).attr("href"); // Get current url.
    // $(this).attr("href", newUrl); // Set herf value.
    //cmPrimary
    //var aUrl = '<?php echo(config('app.asset_url')); ?>';
    //alert(aUrl);
    $("#cmPrimary").attr("href", "makeprimary/"+param);

  }

</script>

<?php
/*
<!-- Select2 -->
<script src="{{ config('app.asset_url') }}/admin/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ config('app.asset_url') }}/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="{{ config('app.asset_url') }}/admin/plugins/moment/moment.min.js"></script>
<script src="{{ config('app.asset_url') }}/admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
 */
?>
  <!-- jQuery -->
  <script src="{{ config('app.asset_url') }}/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ config('app.asset_url') }}/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="{{ config('app.asset_url') }}/admin/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="{{ config('app.asset_url') }}/admin/plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{ config('app.asset_url') }}/admin/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ config('app.asset_url') }}/admin/dist/js/demo.js"></script>

@stop


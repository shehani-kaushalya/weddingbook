@extends('layouts.admin_app')
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@stop
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
              <h3 class="card-title">Staff Members List  </h3>
              <a href="{{ route('staff.add') }}" class="btn btn-primary pull-right" style="text-align: right; float: right; margin-right: 20px; margin-top: 10px;" > Add Staff Member  </a>
            </div>

            <!-- /.card-header -->
            <div class="card-body">

              @if(Session::has('error_message'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    {!! session('error_message') !!}
                </div>
              @endif

              @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    {!! session('success_message') !!}
                </div>
              @endif


              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Member Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @php
                  $i = 1
                @endphp
                @foreach($staff_users as $staff)

                    <tr>
                      <td> {{ $i++ }} </td>
                      <td> {{ $staff->first_name }}  {{ $staff->last_name }} </td>
                      <td> {{ $staff->email }} </td>
                      <td>
                        @if($staff->status == '100')
                          Active
                        @else
                          Inactive
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('staff') }}/{{ $staff->id }}" class="btn btn-success"> View </a>
                        <a href="{{ route('staff.edit') }}/{{ $staff->id }}" class="btn btn-primary"> Edit </a>
                        <a href="{{ route('staff') }}/{{ $staff->id }}" class="btn btn-danger"> Delete </a>
                      </td>

                    </tr>

                @endforeach


                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Photo</th>
                  <th>Member Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>&nbsp;</th>
                </tr>
                </tfoot>
              </table>
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

<script src="{{ config('app.asset_url') }}/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ config('app.asset_url') }}/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

@stop

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
                    <h1 class="m-0 text-dark">Vendors</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vendors</li>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Vendors List </h3>
                        {{-- <a href="{{ route('customers.add') }}" class="btn btn-primary pull-right"
                           style="text-align: right; float: right; margin-right: 20px; margin-top: 10px;"> Add Customer
                        </a> --}}
                        <a href="{{ route('admin.vendors.export') }}" class="btn btn-primary pull-right btn-sm"
                           target="_blank" 
                           style="text-align: right; float: right;"> Export Vendors
                        </a>
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
                            <h5><i class="icon fas fa-check"></i> Succsess!</h5>
                            {!! session('success_message') !!}
                        </div>
                        @endif

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vendors Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1 @endphp
                                @foreach($vendors as $vendor)
                                    @if(!$vendor->isVendor())
                                        @continue @endif
                                    <tr>
                                        <td> {{ $i++ }} </td>
                                        <td>
                                            {{ $vendor->first_name }} {{ $vendor->last_name }}
                                        </td>

                                        <td> {{ $vendor->email }} </td>

                                        <td>
                                            {{ $vendor->status() }}
                                        </td>

                                        <td style="text-align:end;">
                                            @if(!in_array($vendor->verify_status, [\App\User::EMAIL_VERIFIED, \App\User::MOBILE_VERIFIED, \App\User::BOTH_VERIFIED]))
                                            {{-- @if($vendor->status == \App\User::PENDING) --}}
                                                <a href="{{ route('admin.vendors.verify', $vendor->id) }}" class="btn btn-success">
                                                    Verify</a>
                                            @endif
                                            <a href="{{ route('admin.vendors.show', $vendor->id) }}" class="btn btn-info">
                                                View </a>
                                            <!-- <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="btn btn-secondary">
                                                Edit </a> -->
                                            <a href="{{ route('admin.vendors.delete', $vendor->id) }}" class="btn btn-danger">
                                                Delete </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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
</div>

@stop


@section('custom_js')

<script src="{{ config('app.asset_url') }}/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ config('app.asset_url') }}/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "pagingType": "full_numbers",
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

@stop

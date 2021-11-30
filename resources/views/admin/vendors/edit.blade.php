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
                                    <th>Vendors Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1
                                @endphp
                                @foreach($vendors as $vendor)
                                @if(!$vendor->isVendor())
                                @continue
                                @endif
                                <tr>
                                    <td> {{ $i++ }} </td>
                                    <td>
                                        @if($vendor->image == '')
                                            <img src="{{ config('app.asset_url') }}/admin/dist/img/avatar5.png"
                                                class="img-circle elevation-2" width="32" style="width:32px; height:32px;"
                                                alt="User Image"> 
                                            {{  $vendor->first_name }} {{ $vendor->last_name }}
                                        @else
                                            <img src="{{ config('app.asset_url') }}/vendors/{{ $vendor->image }}"
                                                class="img-circle elevation-2" width="32" style="width:32px; height:32px;"
                                                alt="User Image"> 
                                            {{ $vendor->first_name }} {{ $vendor->last_name }}
                                        @endif
                                    </td>

                                    <td> {{ $vendor->email }} </td>

                                    <td>
                                        @if($vendor->status == '100')
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>

                                    <td style="text-align:end;">
                                        @if(!in_array($vendor->verify_status, [\App\User::EMAIL_VERIFIED, \App\User::MOBILE_VERIFIED, \App\User::BOTH_VERIFIED]))
                                            <a href="{{ route('vendors.show', $vendor->id) }}" class="btn btn-success">
                                                Verify</a>
                                        @endif
                                        <a href="{{ route('vendors.show', $vendor->id) }}" class="btn btn-info">
                                            View </a>
                                        <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-secondary">
                                            Edit </a>
                                        <a href="{{ route('vendors.delete', $vendor->id) }}" class="btn btn-danger">
                                            Delete </a>
                                    </td>
                                </tr>

                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Vendors Name</th>
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
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

@stop

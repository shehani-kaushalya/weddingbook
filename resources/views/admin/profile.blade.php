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
                    <h1 class="m-0 text-dark">Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header align-items-center">
                        <h3 class="card-title">Profile:: {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} </h3>
                        <a href="{{ route('admin.password_change') }}" class="btn btn-primary pull-right ml-2"
                           style="text-align: right; float: right;"> Change Password
                        </a>
                    </div>
                    
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
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                {!! session('success_message') !!}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-9">
                                <table id="example1" class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th class="col-2">Phone: </th>
                                            <td class="col-4">{{ auth()->user()->phone }}</td>
                                            
                                            <th class="col-2">Email: </th>
                                            <td class="col-4">{{ auth()->user()->email }}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-2">Acc. Status: </th>
                                            <td class="col-4">{{ auth()->user()->status() }}</td>
                                            
                                            <th class="col-2">Created At</th>
                                            <td class="col-4">{{ auth()->user()->created_at ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
@section('custom_js')
@stop

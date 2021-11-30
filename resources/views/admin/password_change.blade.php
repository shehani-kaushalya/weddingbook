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
                    <h1 class="m-0 text-dark">Change Password</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
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
                        <h3 class="card-title">Change Password:: {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} </h3>
                    </div>
                    
                    <div class="col px-3">
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
                    </div>

                    <form method="post" action="{{ route('admin.password_change_post') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 control-label">Current Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" required id="password" class="form-control" placeholder="Current Password">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 control-label">New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="new_password" required id="new_password" class="form-control" placeholder="New Password">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 control-label">Confirm Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="new_password_confirmation" required id="new_password_confirmation" class="form-control" placeholder="Confirm New Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right"> Submit </button>
                            <button type="reset" class="btn btn-default float-right mr-3"> Cancel </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@stop
@section('custom_js')
@stop

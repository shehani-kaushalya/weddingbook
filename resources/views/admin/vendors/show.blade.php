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
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vendors</li>
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
                        <h3 class="card-title">Vendor:: {{ $vendorAddress->name }} ({{ $vendor->first_name }} {{ $vendor->last_name }}) </h3>
                        {{-- <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="btn btn-primary pull-right ml-2"
                           style="text-align: right; float: right;"> Edit
                        </a> --}}

                        <a href="{{ route('admin.vendors.list') }}" class="btn btn-secondary pull-right ml-2"
                            style="text-align: right; float: right;"> Back
                         </a>

                        @if($vendor->status == \App\User::PENDING)
                            <a href="{{ route('admin.vendors.approve', $vendor->id) }}" class="btn btn-success pull-right ml-2"
                                style="text-align: right; float: right;"> Approve
                            </a>
                        @endif

                        @if(!in_array($vendor->verify_status, [\App\User::EMAIL_VERIFIED, \App\User::MOBILE_VERIFIED, \App\User::BOTH_VERIFIED]))
                            <a href="{{ route('admin.vendors.verify', $vendor->id) }}" class="btn btn-info pull-right ml-2"
                                style="text-align: right; float: right;"> Verify
                            </a>
                        @endif

                        @if($vendor->status == \App\User::APPROVED || $vendor->status == \App\User::DE_ACTIVE)
                            <a href="{{ route('admin.vendors.activate', $vendor->id) }}" class="btn btn-info pull-right ml-2"
                                style="text-align: right; float: right;"> Activate
                            </a>
                        @endif

                        @if($vendor->status == \App\User::ACTIVE)
                            <a href="{{ route('admin.vendors.deactivate', $vendor->id) }}" class="btn btn-info pull-right ml-2"
                                style="text-align: right; float: right;"> De Activate
                            </a>
                        @endif
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
                            <div class="col-3 pl-4">
                                <img src="{{ asset('vendor/'. $vendorAddress->biz_logo) }}" alt="{{ $vendor->first_name }} {{ $vendor->last_name }}" class="img-thumbnail">
                            </div>
                            <div class="col-9">
                                <table id="example1" class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th class="col-2">Phone: </th>
                                            <td class="col-4">{{ $vendor->phone }}</td>
                                            
                                            <th class="col-2">Email: </th>
                                            <td class="col-4">{{ $vendor->email }}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-2">Acc. Verification: </th>
                                            <td class="col-4">{{ $vendor->verifyStatus() }}</td>
                                            
                                            <th class="col-2">Acc. Status: </th>
                                            <td class="col-4">{{ $vendor->status() }}</td>
                                        </tr>

                                        <tr>
                                            <th class="col-2">Business Category: </th>
                                            <td class="col-4">{{ $vendorAddress->_bizCategory->name ?? '' }}</td>
                                            
                                            <th class="col-2">Business Address: </th>
                                            <td class="col-4">{{ $vendorAddress->address() ?? '' }} @if($vendorAddress->_city) , {{ $vendorAddress->_city->name }} @endif @if($vendorAddress->_district) , {{ $vendorAddress->_district->name }}.  @endif</td>
                                        </tr>

                                        @if($vendor->status == \App\User::APPROVED)
                                            <tr>
                                                <td class="col-12" colspan="4">
                                                    Pending payment...
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        <h3 class="card-title"> Profile Images::</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row align-items-center">
                                    @foreach($vendorImages as $vendorImage)
                                        <div class="col-2">
                                            <img src="{{ asset('vendor/'.$vendorImage->image) }}" class="rounded float-left img-thumbnail" alt="" />
                                        </div>        
                                    @endforeach
                                </div>        
                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        <h3 class="card-title"> About::</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <p>{{ $vendor->about }}</p>   
                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        <h3 class="card-title"> Package Details::</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <p>{{ $packagesPromotion->package_description }}</p>   
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

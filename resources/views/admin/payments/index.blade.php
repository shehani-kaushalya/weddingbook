@extends('layouts.admin_app')
@section('custom_css')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@stop
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Payments</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Payments</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Payments List </h3>
                        <form action="{{ route('admin.payments.export') }}" 
                              target="_blank" method="get" 
                              class="pull-right d-inline"
                              style="float:right">
                            <label class="mr-3">
                                From: <input type="date" name="from">
                            </label>
                            <label class="mr-3">
                                To: <input type="date" name="to">
                            </label>
                            <button type="submit" class="btn btn-primary btn-sm"
                               style="text-align: right; float: right;"> Export Payments
                            </button>
                        </form>
                        <!-- <a href="{{ route('admin.payments.export') }}" class="btn btn-primary pull-right btn-sm"
                           target="_blank" 
                           style="text-align: right; float: right;"> Export Payments
                        </a> -->
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vendor Name</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <!-- <th>&nbsp;</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($payments as $payment)
                                    <tr>
                                        <td> {{ $i++ }} </td>
                                        <td> {{ $payment->vendorAddress->name }} </td>
                                        <td> {{ $payment->description }} </td>
                                        <td> {{ $payment->currency }} {{ number_format($payment->amount, 2) }} </td>
                                        <td> {{ $payment->status() }} </td>
                                        <!-- <td style="text-align:end;">
                                            <a href="#" class="btn btn-info">
                                                View </a>
                                        </td> -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

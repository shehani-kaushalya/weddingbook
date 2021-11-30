@extends('layouts.admin_app')
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{asset('admin//plugins/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/progress-wizard.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    <style>
        #invoice{

        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #3989c6
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -50px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,.invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 1.2em
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit,
        .invoice table .h_fee,
        .invoice table .d_fee,
        .invoice table .tax,
        .invoice table .cus_price{
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #3989c6
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #3989c6;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 1.4em;
            border-top: 1px solid #3989c6
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px!important;
                overflow: hidden!important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }

        .tab-content{
            padding-top: 1em;
        }

        .center{
            width: 3em;
            margin: 0 auto;
            text-align: center;
        }

        .label__checkbox {
            display: none;
        }
        .label__check {
            font-family: 'Lato', monospace;
            font-size: calc(1rem + 1vw);
            border-radius: 50%;
            border: 5px solid rgba(0, 0, 0, 0.1);
            background: white;
            vertical-align: middle;
            width: 1.5em;
            height: 1.5em;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border 0.3s ease;
        }
        .label__check i.icon {
            opacity: 0.2;
            font-size: calc(0.5rem + 0.8vw);
            color: transparent;
            transition: opacity 0.3s 0.1s ease;
            -webkit-text-stroke: 2px rgba(0, 0, 0, 0.5);
        }
        .label__check:hover {
            border: 5px solid rgba(0, 0, 0, 0.2);
        }
        .label__checkbox:checked + .label__text .label__check {
            -webkit-animation: check 0.5s cubic-bezier(0.895, 0.03, 0.685, 0.22) forwards;
            animation: check 0.5s cubic-bezier(0.895, 0.03, 0.685, 0.22) forwards;
        }
        .label__checkbox:checked + .label__text .label__check .icon {
            opacity: 1;
            -webkit-transform: scale(0);
            transform: scale(0);
            color: white;
            -webkit-text-stroke: 0;
            -webkit-animation: icon 0.3s cubic-bezier(1, 0.008, 0.565, 1.65) 0.1s 1 forwards;
            animation: icon 0.3s cubic-bezier(1, 0.008, 0.565, 1.65) 0.1s 1 forwards;
        }
        @-webkit-keyframes icon {
            from {
                opacity: 0;
                -webkit-transform: scale(0.3);
                transform: scale(0.3);
            }
            to {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }
        @keyframes icon {
            from {
                opacity: 0;
                -webkit-transform: scale(0.3);
                transform: scale(0.3);
            }
            to {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }
        @-webkit-keyframes check {
            0% {
                width: 1em;
                height: 1em;
                border-width: 5px;
            }
            10% {
                width: 1em;
                height: 1em;
                opacity: 0.1;
                background: rgba(0, 0, 0, 0.2);
                border-width: 15px;
            }
            12% {
                width: 1em;
                height: 1em;
                opacity: 0.4;
                background: rgba(0, 0, 0, 0.1);
                border-width: 0;
            }
            50% {
                width: 1.5em;
                height: 1.5em;
                background: #00d478;
                border: 0;
                opacity: 0.6;
            }
            100% {
                width: 1.5em;
                height: 1.5em;
                background: #00d478;
                border: 0;
                opacity: 1;
            }
        }
        @keyframes check {
            0% {
                width: 1em;
                height: 1em;
                border-width: 5px;
            }
            10% {
                width: 1em;
                height: 1em;
                opacity: 0.1;
                background: rgba(0, 0, 0, 0.2);
                border-width: 15px;
            }
            12% {
                width: 1em;
                height: 1em;
                opacity: 0.4;
                background: rgba(0, 0, 0, 0.1);
                border-width: 0;
            }
            50% {
                width: 1.5em;
                height: 1.5em;
                background: #00d478;
                border: 0;
                opacity: 0.6;
            }
            100% {
                width: 1.5em;
                height: 1.5em;
                background: #00d478;
                border: 0;
                opacity: 1;
            }
        }

        .inEdit input{
            text-align: right;
            background: transparent;
            border: none;
            width: 100%;
            max-width: fit-content !important;
            box-sizing: border-box;
            -webkit-box-sizing:border-box;
            -moz-box-sizing: border-box;
        }

        @media (min-width: 1200px){
            .modal-xl {
                max-width: 1200px;
            }
        }

        .progress-indicator>li .bubble{
            width: 0;
        }

        .progress-indicator>li:first-child .bubble:after, .progress-indicator>li:first-child .bubble:before{
            width: 100%;
        }

        .progress-indicator>li:last-child .bubble:after, .progress-indicator>li:last-child .bubble:before{
            width: 100%;
        }

        .progress-indicator li{
            text-align: left;
        }

        /* timeline style */

        .tracking-detail {
            padding:3rem 0
        }
        #tracking {
            margin-bottom:1rem
        }
        [class*=tracking-status-] p {
            margin:0;
            font-size:1.1rem;
            color:#fff;
            text-transform:uppercase;
            text-align:center
        }
        [class*=tracking-status-] {
            padding:1.6rem 0
        }
        .tracking-status-intransit {
            background-color:#65aee0
        }
        .tracking-status-outfordelivery {
            background-color:#f5a551
        }
        .tracking-status-deliveryoffice {
            background-color:#f7dc6f
        }
        .tracking-status-delivered {
            background-color:#4cbb87
        }
        .tracking-status-attemptfail {
            background-color:#b789c7
        }
        .tracking-status-error,.tracking-status-exception {
            background-color:#d26759
        }
        .tracking-status-expired {
            background-color:#616e7d
        }
        .tracking-status-pending {
            background-color:#ccc
        }
        .tracking-status-inforeceived {
            background-color:#214977
        }
        .tracking-item {
            border-left:1px solid #e5e5e5;
            position:relative;
            padding:2rem 1.5rem .5rem 2.5rem;
            font-size:.9rem;
            margin-left:3rem;
            min-height:5rem
        }
        .tracking-item:last-child {
            padding-bottom:4rem
        }
        .tracking-item .tracking-date {
            margin-bottom:.5rem
        }
        .tracking-item .tracking-date span {
            color:#888;
            font-size:85%;
            padding-left:.4rem
        }
        .tracking-item .tracking-content {
            padding:.5rem .8rem;
            background-color:#f4f4f4;
            border-radius:.5rem
        }
        .tracking-item .tracking-content span {
            display:block;
            color:#888;
            font-size:85%
        }
        .tracking-item .tracking-icon {
            line-height:2.6rem;
            position:absolute;
            left:-1.3rem;
            width:2.6rem;
            height:2.6rem;
            text-align:center;
            border-radius:50%;
            font-size:1.1rem;
            background-color:#fff;
            color:#fff
        }
        .tracking-item .tracking-icon.status-sponsored {
            background-color:#f68
        }
        .tracking-item .tracking-icon.status-delivered {
            background-color:#4cbb87
        }
        .tracking-item .tracking-icon.status-outfordelivery {
            background-color:#f5a551
        }
        .tracking-item .tracking-icon.status-deliveryoffice {
            background-color:#f7dc6f
        }
        .tracking-item .tracking-icon.status-attemptfail {
            background-color:#b789c7
        }
        .tracking-item .tracking-icon.status-exception {
            background-color:#d26759
        }
        .tracking-item .tracking-icon.status-inforeceived {
            background-color:#214977
        }
        .tracking-item .tracking-icon.status-intransit {
            color:#e5e5e5;
            border:1px solid #e5e5e5;
            font-size:.6rem
        }
        @media(min-width:992px) {
            .tracking-item {
                margin-left:10rem
            }
            .tracking-item .tracking-date {
                position:absolute;
                left:-10rem;
                width:7.5rem;
                text-align:right
            }
            .tracking-item .tracking-date span {
                display:block
            }
            .tracking-item .tracking-content {
                padding:0;
                background-color:transparent
            }
        }

        .in-tracking{
            border-left: 1px solid green;
        }

        .in-tracking path{
            fill: green;
        }
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
                        <h1>View Deliveries</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">View Deliveries</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Title</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($data['deliveries'] as $delivery)
                                <tr>
                                    <td>{{$delivery->id}}</td>
                                    <td>{{$delivery->related_type == \App\Delivery::DR_DELIVERY ? 'Delivery Request Delivery' :
                                          ($delivery->related_type == \App\Delivery::PR_DELIVERY ? 'Purchase Request Delivery' : 'Normal Order Delivery')}}</td>
                                    <td>{{$delivery->status == \App\Delivery::ACTIVE ? 'Order Shipped' : ''}}</td>
                                    <td>{{$delivery->created_at}}</td>
                                    <td><a href="#" class="btn btn-sm btn-success" id="btn-delivery-view" data-id="{{$delivery->id}}"><i class="fas fa-eye"></i> View Details</a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- model for purchasing -->
    <div class="modal fade" id="modal-receiving">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="model_title">Delivery Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-left">
                                <p>Lorem ipsm dollar sint</p>
                                <h2>Estimated Arrival {{\Carbon\Carbon::createFromDate($data['deliveries'][0]->estimated_date)->diffForHumans()}} - <label>{{$data['deliveries'][0]->estimated_date}}</label></h2>
                                <p> 11/3 Janapriya mw, Koralawella, Moratuwa, 10400</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-lg-5">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Tracking Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                    <div class="card-body">
                                        <div id="tracking-pre"></div>
                                        <div id="tracking">
                                            <div class="tracking-list">
                                                @foreach($data['delivery_status'] as $delivery_status)
                                                    <div class="tracking-item" id="tracking-item{{$delivery_status->id}}">
                                                        <div class="tracking-icon status-intransit">
                                                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                                <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                            </svg>
                                                            <!-- <i class="fas fa-circle"></i> -->
                                                        </div>
                                                        <div class="tracking-date"><span class="tracking-date-span">Nov 29, 2019</span><span class="tracking-date-time">06:08 PM</span></div>
                                                        <div class="tracking-content">{{$delivery_status->name}}<span class="tracking-desc">KUALA LUMPUR (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                                                    </div>
                                                @endforeach
{{--
                                                <div class="tracking-item">
                                                    <div class="tracking-icon status-intransit">
                                                        <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                        </svg>
                                                        <!-- <i class="fas fa-circle"></i> -->
                                                    </div>
                                                    <div class="tracking-date">Nov 29, 2019<span>06:08 PM</span></div>
                                                    <div class="tracking-content">Received at airport<span>SHENZHEN, CHINA, PEOPLE'S REPUBLIC</span></div>
                                                </div>
                                                <div class="tracking-item">
                                                    <div class="tracking-icon status-intransit">
                                                        <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                        </svg>
                                                        <!-- <i class="fas fa-circle"></i> -->
                                                    </div>
                                                    <div class="tracking-date">Nov 29, 2019<span>06:08 PM</span></div>
                                                    <div class="tracking-content">Hand over to air transport<span>KUALA LUMPUR (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                                                </div>
                                                <div class="tracking-item">
                                                    <div class="tracking-icon status-intransit">
                                                        <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                        </svg>
                                                        <!-- <i class="fas fa-circle"></i> -->
                                                    </div>
                                                    <div class="tracking-date">Nov 29, 2019<span>06:08 PM</span></div>
                                                    <div class="tracking-content">Items Shipped<span>KUALA LUMPUR (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                                                </div>
                                                <div class="tracking-item">
                                                    <div class="tracking-icon status-intransit">
                                                        <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                        </svg>
                                                        <!-- <i class="fas fa-circle"></i> -->
                                                    </div>
                                                    <div class="tracking-date">Nov 29, 2019<span>06:08 PM</span></div>
                                                    <div class="tracking-content">Arrived at destination country<span>KUALA LUMPUR (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                                                </div>
                                                <div class="tracking-item">
                                                    <div class="tracking-icon status-intransit">
                                                        <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                        </svg>
                                                        <!-- <i class="fas fa-circle"></i> -->
                                                    </div>
                                                    <div class="tracking-date">Nov 29, 2019<span>06:08 PM</span></div>
                                                    <div class="tracking-content">Items at Inward office of exchanged<span>KUALA LUMPUR (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                                                </div>
                                                <div class="tracking-item">
                                                    <div class="tracking-icon status-outfordelivery">
                                                        <svg class="svg-inline--fa fa-shipping-fast fa-w-20" aria-hidden="true" data-prefix="fas" data-icon="shipping-fast" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H112C85.5 0 64 21.5 64 48v48H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h272c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H40c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H64v128c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z"></path>
                                                        </svg>
                                                        <!-- <i class="fas fa-shipping-fast"></i> -->
                                                    </div>
                                                    <div class="tracking-date">Nov 29, 2019<span>06:08 PM</span></div>
                                                    <div class="tracking-content"> Received by customer<span>KUALA LUMPUR (LOGISTICS HUB), MALAYSIA, MALAYSIA</span></div>
                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-gray">
                                        <div class="card-header">
                                            <h3 class="card-title">Items Details</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <form role="form">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>Item Description</th>
                                                                    <th>Supplier</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="delivery-items-container">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer">
                                                <div class="form-group">
                                                    <label for="tracking_status">Delivery Status</label>
                                                    <select class="form-control" id="tracking_status">
                                                        @foreach($data['delivery_status'] as $delivery_status)
                                                            <option value="{{$delivery_status->id}}">{{$delivery_status->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                                                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="trackingDescription">Delivery Description</label>
                                                    <textarea class="form-control" id="trackingDescription" placeholder="Tracking Description"></textarea>
                                                </div>
                                                <button type="button" class="btn btn-primary float-right" id="update-tracking">Update Tracking</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    <script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('admin/dist/js/demo.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <!-- page script -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script src="{{asset('admin/plugins/toastr/toastr.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
        $(document).on('click',"#btn-delivery-view", function () {
            let deliveryId = $(this).data('id');
            $.ajax({
                url: "{{route('admin.delivery.items.get')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    id: deliveryId
                },
                success: function (data) {
                    console.log(data);
                    $("#update-tracking").attr("data-deliveryid", deliveryId);
                    $("#delivery-items-container").html("");
                    $.each(data, function (i, v) {
                      $("#delivery-items-container").append(' <tr class="delivery-item">' +
                          '                                     <td><b>'+v.dr_receive_items.invoice_items.dr_items.product_code+'</b> - '+v.dr_receive_items.invoice_items.dr_items.product_name+'</td>' +
                          '                                     <td><a target="_blank" href="http://'+v.dr_receive_items.invoice_items.dr_items.suppliers.website+'" >'+v.dr_receive_items.invoice_items.dr_items.suppliers.name+'</a> </td>' +
                          '                                     <td>LKR '+v.dr_receive_items.invoice_items.invoice.amount+'</td>' +
                          '                                   </tr>');
                    });
                    $('#modal-receiving').modal('show');
                }, error: function (error) {
                    console.log(error);
                }
            });

            getTrackingDetails(deliveryId);
        });

        $("#update-tracking").on('click', function () {
            let deliveryId = $(this).data('deliveryid');
            let statusId = $("#tracking_status").val();
            let trackingDes = $("#trackingDescription").val();
            let trackingDatetime = $(".datetimepicker-input").val();
            console.log(deliveryId, statusId, trackingDes, moment(trackingDatetime).format("YYYY-MM-DD HH:mm:ss"));
            $.ajax({
                url: "{{route('admin.delivery.tracking.update.do')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    id:deliveryId,
                    status: statusId,
                    trackingDes: trackingDes,
                    trackingDatetime: moment(trackingDatetime).format("YYYY-MM-DD HH:mm:ss")
                },
                success:function (data) {
                    console.log(data);
                    toastr.success('Tracking updated successfully');
                    getTrackingDetails(deliveryId);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Tracking update error');
                }
            })
        });

        function getTrackingDetails(id) {
            $.ajax({
                url:"{{route('admin.delivery.tracking.status.get')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function (data) {
                    console.log(data);
                    $(".tracking-item .tracking-date-span").text("");
                    $(".tracking-item .tracking-date-time").text("");
                    $(".tracking-item .tracking-desc").text("Tracking need to update");
                    $.each(data, function (i, v) {
                        console.log(i, v);
                        $("#tracking-item"+v.tracking_status_id+"").addClass('in-tracking');
                        $("#tracking-item"+v.tracking_status_id+"").removeClass('current');
                        if(v.status == {{\App\DeliveryTrackingStatus::CURRENT}}){
                            $("#tracking-item"+v.tracking_status_id+"").addClass('current');
                        }

                        $(".in-tracking.current").nextAll().removeClass('in-tracking');
                        $("#tracking-item"+v.tracking_status_id+" .tracking-date-span").text(moment(v.dateTime).format("MMM DD, YYYY"));
                        $("#tracking-item"+v.tracking_status_id+" .tracking-date-time").text(moment(v.dateTime).format("hh:mm A"));
                        $("#tracking-item"+v.tracking_status_id+" .tracking-desc").text(v.description);
                    });
                },
                error: function (error) {
                    console.log(error);

                }

            })
        }
    </script>
@stop

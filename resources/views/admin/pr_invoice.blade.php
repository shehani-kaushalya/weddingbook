@extends('layouts.admin_app')
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admin//plugins/toastr/toastr.min.css')}}">
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

    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Purchase Requests</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Purchase Request</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Invoices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="contact" aria-selected="false">Payments</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div id="invoice">

                                <div class="toolbar d-print-none">
                                    <h2>Purchase Request - #{{$data['pr']->id}}</h2>
                                    <div class="text-right">
                                        {{--<button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>--}}
                                        {{-- <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>--}}
                                    </div>
                                    <hr>
                                </div>
                                <div class="invoice overflow-auto">
                                    <div style="min-width: 600px">
                                      {{--  <header>
                                            <div class="row">
                                                <div class="col">
                                                    <h1><a target="_blank" href="http://www.amax.lk">
                                                            AMAX LOGO
                                                            --}}{{--  <img src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png" data-holder-rendered="true" />--}}{{--
                                                        </a></h1>
                                                </div>
                                                <div class="col company-details">
                                                    <h2 class="name">
                                                        <a target="_blank" href="http://www.amax.lk">
                                                            Amax Pvt Ltd
                                                        </a>
                                                    </h2>
                                                    <div>11/3 amax address</div>
                                                    <div>amax contact number</div>
                                                    <div>help@amax.lk</div>
                                                </div>
                                            </div>
                                        </header>--}}
                                        <main>
                                            <div class="row contacts">
                                                <div class="col invoice-to">
                                                    <div class="text-gray-light">REQUESTED BY:</div>
                                                    <h2 class="to">{{$data['pr']->customers->first_name." ".$data['pr']->customers->last_name}}</h2>
                                                    <div class="address">11/3 Testing address, city, sri lanka</div>
                                                    <div class="email"><a href="mailto:{{$data['pr']->customers->email}}">{{$data['pr']->customers->email}}</a> | {{$data['pr']->customers->phone}}</div>
                                                </div>
                                                <div class="col invoice-details">
                                                {{--    <h1 class="invoice-id">INVOICE #PR{{$pr->id}}</h1>--}}
                                                    <h4 class="invoice-id">STATUS :
                                                        {!! $data['pr']->status == \App\PurchaseRequest::PENDING ? '<span style="color: red;">PENDING</span>' :
                                                                ($data['pr']->status == \App\PurchaseRequest::APPROVED ? '<span style="color: #28a745;">APPROVED</span>' :
                                                                    ($data['pr']->status == \App\PurchaseRequest::PROCESSING ? '<span style="color: #0074E8;">PROCESSING</span>':
                                                                        '<span style="color: #ffc107;">DECLINED</span>')) !!}
                                                    </h4>
                                                    <div class="date">Date of Request: {{$data['pr']->created_at}}</div>
                                                    {{-- <div class="date">Due Date: 30/10/2019</div>--}}
                                                </div>
                                            </div>
                                            <table id="invoice" border="0" cellspacing="0" cellpadding="0">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>#</th>
                                                    <th class="text-left">DESCRIPTION</th>
                                                    <th class="text-right">Customer Price</th>
                                                    <th class="text-right">Final Price</th>
                                                    <th class="text-right">Qty</th>
                                                    <th class="text-right">Tax</th>
                                                    <th class="text-right">Handling Fee</th>
                                                    <th class="text-right">Delivery Fee</th>
                                                    <th class="text-right">TOTAL</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data['pr']->items as $key=>$item)
                                                    <tr class="invoice_item" data-id="{{$item->id}}">
                                                        <td>
                                                            <div class="center">
                                                                <label class="label">
                                                                    <input  class="label__checkbox" type="checkbox" checked="checked"/>
                                                                    <span class="label__text">
                                                                      <span class="label__check">
                                                                        <i class="fa fa-check icon"></i>
                                                                      </span>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="no">{{$key+1}}</td>
                                                        <td class="text-left">
                                                            <h3>{{$item->product_name}} - {{$item->product_code}}</h3>
                                                            <p>{{$item->description}}</p>
                                                            <a href="{{$item->product_url}}" target="_blank" class="hidden-print" >{{$item->product_url}}</a>
                                                            <p>{{$item->suppliers->name}} - {{$item->seller_name}} </p>
                                                        </td>
                                                        <td class="cus_price">{{$item->amount ? $item->amount : '0.00'}}</td>
                                                        <td class="unit editMe">{{$item->amount ? $item->amount : '0.00'}}</td>
                                                        <td class="qty editMe">{{$item->qty}}</td>
                                                        <td class="tax editMe">{{$item->tax ? $item->tax : '0.00'}}</td>
                                                        <td class="h_fee editMe">{{$item->handling_fee ? $item->handling_fee : '0.00'}}</td>
                                                        <td class="d_fee editMe">{{$item->delivery_cost ? $item->delivery_cost : '0.00'}}</td>
                                                        <td class="total">LKR 0.00</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                {{--     <tr>
                                                         <td colspan="5"></td>
                                                         <td colspan="2">SUBTOTAL</td>
                                                         <td id="sub_total">0.00</td>
                                                     </tr>
                                                     <tr>
                                                         <td colspan="5"></td>
                                                         <td colspan="2">DELIVERY COST</td>
                                                         <td id="del_cost" class="editMe">0.00</td>
                                                     </tr>--}}
                                                <tr>
                                                    <td colspan="7"></td>
                                                    <td colspan="2">GRAND TOTAL</td>
                                                    <td id="grand_total">0.00</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                           {{-- <div class="thanks">Thank you!</div>
                                            <div class="notices">
                                                <div>NOTICE:</div>
                                                <div class="notice" id="editor1" contenteditable="true">Testing notice</div>
                                            </div>--}}
                                        </main>
                                       {{-- <footer>
                                            Invoice was created on a computer and is valid without the signature and seal.
                                        </footer>--}}
                                    </div>
                                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                                    <div></div>
                                    <div class="invoice-controllers float-right" style="margin-top: 1em;">
                                        <button class="btn btn-md btn-success" id="update-request">Update Request</button>
                                        <button class="btn btn-md btn-warning" id="create-invoice">Create Invoice</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            @if(count($data['invoices']) > 0)
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice No</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Payment Method</th>
                                    <th>Amount</th>
                                    <th>Discount</th>
                                    <th>Processed User</th>
                                    <th>Created date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['invoices'] as $invoice)
                                        <tr>
                                            <td>{{$invoice->id}}</td>
                                            <td>{{$invoice->invoice_no}}</td>
                                            <td>
                                                {{$invoice->type == \App\Invoice::PR_INVOICE ? 'Purchase Request' :
                                                    ($invoice->type == \App\Invoice::DR_INVOICE ? 'Delivery Request' : 'Sales Order')}}
                                            </td>
                                            <td>
                                                {{$invoice->status == \App\Invoice::PENDING ? 'Pending' :
                                                    ($invoice->status == \App\Invoice::DE_ACTIVE ? 'Canceled' : 'Approved')}}
                                            </td>
                                            <td>{{$invoice->payment_method}}</td>
                                            <td>{{number_format($invoice->amount,2,'.',',')}}</td>
                                            <td>{{$invoice->discount}}</td>
                                            <td>{{$invoice->users->first_name}} {{$invoice->users->last_name}}</td>
                                            <td>{{$invoice->created_at}}</td>
                                            <td style="text-align: center;">
                                                <button class="btn btn-sm btn-success">view</button>
                                                <button class="btn btn-sm btn-danger">Edit</button>
                                                <button class="btn btn-sm btn-warning">Payments</button>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice No</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Payment Method</th>
                                    <th>Amount</th>
                                    <th>Discount</th>
                                    <th>Processed User</th>
                                    <th>Created date</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                            @else
                                <h3>No invoice found..</h3>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">

                        </div>

                    </div>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@stop

@section('custom_js')
    <script src="{{asset('admin/plugins/toastr/toastr.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{asset('js/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#printInvoice').click(function(){
                console.log('click')
                Popup($('.invoice')[0].outerHTML);
                function Popup(data)
                {
                    window.print();
                    return true;
                }
            });
        });
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.inline( 'editor1' );
        config.extraPlugins = 'cloudservices';


    </script>
    <script src="{{asset('js/SimpleTableCellEditor.js')}}"></script>
    <script>
        const editor = new SimpleTableCellEditor("invoice");

        editor.SetEditableClass("editMe");
        $('#invoice').on("cell:edited", function (event) {
            console.log(`'${event.oldValue}' changed to '${event.newValue}'`);
            console.log(event.element);
            priceCalculation();
        });

        priceCalculation();
        function priceCalculation() {
            let grand_total = 0;
            $.each($(".invoice_item"), function (i,v) {
                console.log($(v).find('.unit').text());
                let price = parseFloat($(v).find('.unit').text()).toFixed(2);
                let qty = parseFloat($(v).find('.qty').text());
                let tax = parseFloat($(v).find('.tax').text());
                let h_fee = parseFloat($(v).find('.h_fee').text());
                let d_fee = parseFloat($(v).find('.d_fee').text());
                let tax_n_fee = parseFloat(tax+ h_fee +d_fee);
                let price_n_qty = parseFloat(price * qty);
                grand_total += (tax_n_fee + price_n_qty);
                let total = parseFloat(tax_n_fee + price_n_qty).toFixed(2);
                console.log(price,qty,tax,h_fee, tax_n_fee);
                $(v).find('.total').text(total);
            });
            /*let del_cost = parseFloat($("#del_cost").text());
            $("#del_cost").text(del_cost.toFixed(2));
            $("#sub_total").text(grand_total.toFixed(2));*/
            $("#grand_total").text((grand_total).toFixed(2));
        }

        $("#update-request").on('click',function () {
            let item_data = [];
            if ($(".label__checkbox:checked").parents(".invoice_item").length < 1){
                toastr.error('You don\'t have any items selected.');
                return false;
            }
            $.each($(".label__checkbox:checked").parents(".invoice_item"), function (i,v) {
                let item = {
                    id : $(v).data('id'),
                    price : parseFloat($(v).find('.unit').text()).toFixed(2),
                    qty : parseFloat($(v).find('.qty').text()),
                    tax : parseFloat($(v).find('.tax').text()),
                    h_fee : parseFloat($(v).find('.h_fee').text()),
                    d_fee : parseFloat($(v).find('.d_fee').text())
                };

                item_data.push(item);
            });
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update the request",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('admin.purchase.request.update.do')}}",
                        method: "POST",
                        dataType: "JSON",
                        data: {
                            id: "{{$data['pr']->id}}",
                            data: item_data
                        },
                        success: function (data) {
                            console.log(data);
                            Swal.fire(
                                'Request updated!',
                                'Request has been updated successfully.',
                                'success'
                            );
                            window.location.reload();
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    })
                }
            });
        });

        $("#create-invoice").on('click',function () {
            let item_data = [];
            if ($(".label__checkbox:checked").parents(".invoice_item").length < 1){
                toastr.error('You don\'t have any items selected.');
                return false;
            }
            $.each($(".label__checkbox:checked").parents(".invoice_item"), function (i,v) {
                let item = {
                    id : $(v).data('id'),
                    price : parseFloat($(v).find('.unit').text()).toFixed(2),
                    qty : parseFloat($(v).find('.qty').text()),
                    tax : parseFloat($(v).find('.tax').text()),
                    h_fee : parseFloat($(v).find('.h_fee').text()),
                    d_fee : parseFloat($(v).find('.d_fee').text())
                };

                item_data.push(item);
            });
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update the invoice",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('admin.purchase.request.invoice.do')}}",
                        method: "POST",
                        dataType: "JSON",
                        data: {
                            id: "{{$data['pr']->id}}",
                            data: item_data,
                            total: $("#grand_total").text()
                        },
                        success: function (data) {
                            console.log(data);
                            Swal.fire(
                                'Invoice updated!',
                                'Invoice has been updated successfully.',
                                'success'
                            );
                              window.location.reload();
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    })
                }
            });
        });
    </script>
    @endsection
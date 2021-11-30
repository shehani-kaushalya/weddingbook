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
                            <li class="breadcrumb-item active">Delivery Request</li>
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
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Delivery Request</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Invoices</a>
                        </li>
                      {{--  <li class="nav-item">
                            <a class="nav-link" id="purchase-tab" data-toggle="tab" href="#purchase" role="tab" aria-controls="purchase" aria-selected="false">Purchasing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="contact" aria-selected="false">Payments</a>
                        </li>--}}
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div id="invoice">

                                <div class="toolbar d-print-none">
                                    <h2>Delivery Request - #{{$data['dr']->id}}</h2>
                                    <div class="text-right">
                                        {{--<button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>--}}
                                        {{-- <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>--}}
                                    </div>
                                    <hr>
                                </div>
                                <div class="invoice overflow-auto">
                                    <div style="min-width: 600px">
                                        <main>
                                            <div class="row contacts">
                                                <div class="col invoice-to">
                                                    <div class="text-gray-light">REQUESTED BY:</div>
                                                    <h2 class="to">{{$data['dr']->customers->first_name." ".$data['dr']->customers->last_name}}</h2>
                                                    <div class="address">11/3 Testing address, city, sri lanka</div>
                                                    <div class="email"><a href="mailto:{{$data['dr']->customers->email}}">{{$data['dr']->customers->email}}</a> | {{$data['dr']->customers->phone}}</div>
                                                </div>
                                                <div class="col invoice-details">
                                                {{--    <h1 class="invoice-id">INVOICE #PR{{$pr->id}}</h1>--}}
                                                    <h4 class="invoice-id">STATUS :
                                                        {!! $data['dr']->status == \App\PurchaseRequest::PENDING ? '<span style="color: red;">PENDING</span>' :
                                                                ($data['dr']->status == \App\PurchaseRequest::APPROVED ? '<span style="color: #28a745;">APPROVED</span>' :
                                                                    ($data['dr']->status == \App\PurchaseRequest::PROCESSING ? '<span style="color: #0074E8;">PROCESSING</span>':
                                                                        '<span style="color: #ffc107;">DECLINED</span>')) !!}
                                                    </h4>
                                                    <div class="date">Date of Request: {{$data['dr']->created_at}}</div>
                                                    {{-- <div class="date">Due Date: 30/10/2019</div>--}}
                                                </div>
                                            </div>
                                            <table id="invoice" border="0" cellspacing="0" cellpadding="0">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>#</th>
                                                    <th class="text-left">DESCRIPTION</th>
                                                    <th class="text-right">Price</th>
                                                    <th class="text-right">Qty</th>
                                                    <th class="text-right">Tax</th>
                                                    <th class="text-right">Handling Fee</th>
                                                    <th class="text-right">Delivery Method</th>
                                                    <th class="text-right">Delivery Fee</th>
                                                    <th class="text-right">TOTAL</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data['dr']->items as $key=>$item)
                                                    <tr id="original" class="original invoice_item" data-id="{{$item->id}}">
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
                                                        <td class="unit">{{$item->price ? number_format($item->price,2,'.','') : '0.00'}}</td>
                                                        <td class="qty" data-invoiceQty="{{\App\Services\UtilService::getInvoiceItemTotalQty($item->id)}}">{{$item->qty}}</td>
                                                        <td class="tax editMe">{{$item->tax ? number_format($item->tax,2,'.','') : '0.00'}}</td>
                                                        <td class="h_fee editMe">{{$item->handling_fee ? number_format($item->handling_fee,2,'.','') : '0.00'}}</td>
                                                        <td class="h_fee">
                                                            <div class="form-group">
                                                                <select id="d_method" class="form-control" disabled>
                                                                    @foreach($data['dMethods'] as $dMethod)
                                                                        <option value="{{$dMethod->id}}" {{$dMethod->id == $item->delivery_method ? 'selected' : ''}}>{{$dMethod->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="d_fee editMe">{{$item->delivery_cost ? $item->delivery_cost : '0.00'}}</td>
                                                        <td class="total">LKR 0.00</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="7"></td>
                                                    <td colspan="2">GRAND TOTAL</td>
                                                    <td id="grand_total">0.00</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </main>
                                    </div>
                                    <div class="invoice-controllers float-right" style="margin-top: 1em;">
                                        {{--<button class="btn btn-md btn-success" id="update-request">Update Request</button>--}}
                                        <button class="btn btn-md btn-warning" id="create-invoice">Create Invoice</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
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
                                    @foreach($data['dr']->invoices as $invoice)
                                        <tr>
                                            <td>{{$invoice->id}}</td>
                                            <td id="invoice_no" data-invoice_no="{{$invoice->invoice_no}}">{{$invoice->invoice_no}}</td>
                                            <td>
                                                {{$invoice->type == \App\Invoice::PR_INVOICE ? 'Delivery Request' :
                                                    ($invoice->type == \App\Invoice::DR_INVOICE ? 'Delivery Request' : 'Sales Order')}}
                                            </td>
                                            <td>
                                                {{$invoice->status == \App\Invoice::PENDING ? 'Pending' :
                                                    ($invoice->status == \App\Invoice::DE_ACTIVE ? 'Canceled' : 'Approved')}}
                                            </td>
                                            <td>{{$invoice->payment_method == \App\Payment::BANK_PAYMENT ? 'BANK PAYMENT' : ''}}</td>
                                            <td>{{number_format($invoice->amount,2,'.',',')}}</td>
                                            <td>{{$invoice->discount}}</td>
                                            <td>{{$invoice->users->first_name}} {{$invoice->users->last_name}}</td>
                                            <td>{{$invoice->created_at}}</td>
                                            <td style="text-align: center;">
                                                <button class="btn btn-sm btn-success" type="button" id="btn-view" data-id="{{$invoice->id}}">view</button>
                                             {{--   <button class="btn btn-sm btn-warning" type="button" id="btn-payment" data-id="{{$invoice->id}}">Payments</button>
                                                <button class="btn btn-sm btn-warning" type="button" id="btn-viewDocs" data-id="{{$invoice->id}}">View Documents</button>
                                            --}}</td>
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
                        </div>
                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">

                        </div>
                        <div class="tab-pane fade" id="purchase" role="tabpanel" aria-labelledby="purchase-tab">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice ID</th>
                                        <th>Invoice No</th>
                                        <th>Reference</th>
                                        <th>Status</th>
                                        <th>Created date</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   @foreach($data['dr']->invoices as $invoice)
                                   {{--    @foreach($invoice->purchasing as $purchase)
                                           <tr>
                                               <td>{{$purchase->id}}</td>
                                               <td id="invoice_no" data-invoice_no="{{$purchase->invoice_id}}">{{$purchase->invoice_id}}</td>
                                               <td>
                                                   {{$purchase->invoice_no}}
                                               </td>
                                               <td>
                                                   {{$purchase->reference}}
                                               </td>
                                               <td>{{$purchase->status == \App\Purchasing::PENDING ? 'Pending' :
                                                    ($purchase->status == \App\Purchasing::CANCELED ? 'Canceled' :
                                                        ($purchase->status == \App\Purchasing::COMPLETED ? 'Completed' :
                                                            ($purchase->status == \App\Purchasing::PURCHASED ? 'Purchased' : 'Processing')))}}</td>
                                               <td>{{$purchase->created_at}}</td>
                                               <td style="text-align: center;">
                                                   <button class="btn btn-sm btn-success" type="button" id="btn-purchase-view" data-id="{{$purchase->id}}">view</button>
                                               </td>
                                           </tr>

                                       @endforeach--}}
                                   @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice ID</th>
                                        <th>Invoice No</th>
                                        <th>Reference</th>
                                        <th>Status</th>
                                        <th>Created date</th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
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
    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="model_title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="invoice">

                        <div class="toolbar d-print-none">
                            <h2 class="text-left">Delivery Request - #{{$data['dr']->id}}</h2>
                            <div class="text-right">
                                {{--<button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>--}}
                            </div>
                            <hr>
                        </div>
                        <div class="invoice overflow-auto">
                            <div style="min-width: 600px">
                                  <header>
                                      <div class="row">
                                          <div class="col">
                                              <h1><a target="_blank" href="http://www.amax.lk">
                                                      AMAX LOGO
                                                      {{--todo: add image logo later--}}
                                                      {{--<img src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png" data-holder-rendered="true" />--}}
                                                  </a>
                                              </h1>
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
                                  </header>
                                <main>
                                    <div class="row contacts">
                                        <div class="col invoice-to">
                                            <div class="text-gray-light">REQUESTED BY:</div>
                                            <h2 class="to">{{$data['dr']->customers->first_name." ".$data['dr']->customers->last_name}}</h2>
                                            <div class="address">11/3 Testing address, city, sri lanka</div>
                                            <div class="email"><a href="mailto:{{$data['dr']->customers->email}}">{{$data['dr']->customers->email}}</a> | {{$data['dr']->customers->phone}}</div>
                                        </div>
                                        <div class="col invoice-details">
                                            <h1 class="invoice-id">INVOICE: <span id="invoice_no"></span></h1>
                                            <h4 class="invoice-id">STATUS :
                                                {!! $data['dr']->status == \App\PurchaseRequest::PENDING ? '<span style="color: red;">PENDING</span>' :
                                                        ($data['dr']->status == \App\PurchaseRequest::APPROVED ? '<span style="color: #28a745;">APPROVED</span>' :
                                                            ($data['dr']->status == \App\PurchaseRequest::PROCESSING ? '<span style="color: #0074E8;">PROCESSING</span>':
                                                                '<span style="color: #ffc107;">DECLINED</span>')) !!}
                                            </h4>
                                            <div class="date" id="invoice_date">Invoice Date : {{$data['dr']->created_at}}</div>
                                            {{--<div class="date">Due Date: 30/10/2019</div>--}}
                                        </div>
                                    </div>
                                    <table id="invoice" border="0" cellspacing="0" cellpadding="0">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>#</th>
                                            <th class="text-left">DESCRIPTION</th>
                                            <th class="text-right">Tax</th>
                                            <th class="text-right">Handling Fee</th>
                                            <th class="text-right">Delivery Method</th>
                                            <th class="text-right">Delivery Fee</th>
                                            <th class="text-right">TOTAL</th>
                                        </tr>
                                        </thead>
                                        <tbody id="item-container">

                                        </tbody>
                                        <tfoot>
                                             <tr>
                                                <td colspan="5"></td>
                                                <td colspan="2">GRAND TOTAL</td>
                                                <td id="grand_total">0.00</td>
                                             </tr>
                                        </tfoot>
                                    </table>
                                     <div class="thanks">Thank you!</div>
                                     <div class="notices">
                                         <div>NOTICE:</div>
                                         <div class="notice" id="editor1" contenteditable="true">Testing notice</div>
                                     </div>
                                </main>
                                 <footer>
                                     Invoice was created on a computer and is valid without the signature and seal.
                                 </footer>
                            </div>
                            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="process_delivery_receive">Process to Delivery Receive</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- model for payment -->
    <div class="modal fade" id="modal-payment">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="model_title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="invoice">
{{--
                        <div class="toolbar d-print-none">
                            <h2 class="text-left">Purchase Request - #{{$data['pr']->id}}</h2>
                            <div class="text-right">
                                --}}{{--<button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>--}}{{--
                            </div>
                            <hr>
                        </div>--}}
                        <div class="invoice overflow-auto">
                            <div style="min-width: 600px">
                                <main>
                                    <div class="row contacts">
                                        <div class="col invoice-to">
                                            <div class="text-gray-light">REQUESTED BY:</div>
                                            <h2 class="to">{{$data['dr']->customers->first_name." ".$data['dr']->customers->last_name}}</h2>
                                            <div class="address">11/3 Testing address, city, sri lanka</div>
                                            <div class="email"><a href="mailto:{{$data['dr']->customers->email}}">{{$data['dr']->customers->email}}</a> | {{$data['dr']->customers->phone}}</div>
                                        </div>
                                        <div class="col invoice-details">
                                            <h1 class="invoice-id">INVOICE: <span id="invoice_no"></span></h1>
                                            <h4 class="invoice-id">STATUS :
                                                {!! $data['dr']->status == \App\PurchaseRequest::PENDING ? '<span style="color: red;">PENDING</span>' :
                                                        ($data['dr']->status == \App\PurchaseRequest::APPROVED ? '<span style="color: #28a745;">APPROVED</span>' :
                                                            ($data['dr']->status == \App\PurchaseRequest::PROCESSING ? '<span style="color: #0074E8;">PROCESSING</span>':
                                                                '<span style="color: #ffc107;">DECLINED</span>')) !!}
                                            </h4>
                                            <div class="date" id="invoice_date">Invoice Date : {{$data['dr']->created_at}}</div>
                                            {{--<div class="date">Due Date: 30/10/2019</div>--}}
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
                                            <th class="text-right">Delivery Method</th>
                                            <th class="text-right">Delivery Fee</th>
                                            <th class="text-right">TOTAL</th>
                                        </tr>
                                        </thead>
                                        <tbody id="item-container">

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="8"></td>
                                            <td colspan="2">SUBTOTAL</td>
                                            <td id="sub_total">0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="8"></td>
                                            <td colspan="2">DELIVERY COST</td>
                                            <td id="del_cost" class="editMe">0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="8"></td>
                                            <td colspan="2">GRAND TOTAL</td>
                                            <td id="grand_total">0.00</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </main>
                            </div>
                            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirm_payment">Confirm Payment</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- model for purchasing -->
    <div class="modal fade" id="modal-purchasing">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="model_title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="invoice">

                        <div class="toolbar d-print-none">
                            <h2 class="text-left">Invoice Purchasing</h2>
                            <div class="text-right">

                            </div>
                            <hr>
                        </div>
                        <div class="invoice overflow-auto">
                            <div style="min-width: 600px">
                                <main>
                                    <table id="invoice" border="0" cellspacing="0" cellpadding="0">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>#</th>
                                            <th class="text-left">DESCRIPTION</th>
                                            <th class="text-right">Price</th>
                                            <th class="text-right">Qty</th>
                                            <th class="text-right">Tax</th>
                                            <th class="text-right">Handling Fee</th>
                                            <th class="text-right">Delivery Fee</th>
                                            <th class="text-right">TOTAL</th>
                                        </tr>
                                        </thead>
                                        <tbody id="item-container">

                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </main>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update_purchase">Update Purchase</button>
                </div>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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
                console.log('click');
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
            $.each($(".original.invoice_item"), function (i,v) {
                console.log($(v).find('.unit').text());
                let price = parseFloat($(v).find('.unit').text()).toFixed(2);
                let qty = parseFloat($(v).find('.qty').text());
                let tax = parseFloat($(v).find('.tax').text());
                let h_fee = parseFloat($(v).find('.h_fee').text());
                let d_fee = parseFloat($(v).find('.d_fee').text());
                let tax_n_fee = parseFloat(tax+ h_fee +d_fee);
                let price_n_qty = parseFloat(price * qty);
                grand_total += (tax_n_fee);
                let total = parseFloat(tax_n_fee).toFixed(2);
                console.log(price,qty,tax,h_fee, tax_n_fee);
                $(v).find('.total').text(total);
            });
            $("#grand_total").text((grand_total).toFixed(2));
        }

        $("#update-request").on('click',function () {
            let item_data = [];
            if ($("#original").find(".label__checkbox:checked").parents(".invoice_item").length < 1){
                toastr.error('You don\'t have any items selected.');
                return false;
            }else{
                console.log($("#original").find(".label__checkbox:checked").parents(".invoice_item"));
            }
            $.each($("#original .label__checkbox:checked").parents(".invoice_item"), function (i,v) {
                let item = {
                    id : $(v).data('id'),
                    price : parseFloat($(v).find('.unit').text()).toFixed(2),
                    qty : parseFloat($(v).find('.qty').text()),
                    tax : parseFloat($(v).find('.tax').text()),
                    h_fee : parseFloat($(v).find('.h_fee').text()),
                    d_method :$(v).find('#d_method').val(),
                    d_fee : parseFloat($(v).find('.d_fee').text())
                };

                item_data.push(item);
            });
            console.log(item_data);
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
                            id: "{{$data['dr']->id}}",
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
            if ($("#original").find(".label__checkbox:checked").parents(".invoice_item").length < 1){
                toastr.error('You don\'t have any items selected.');
                return false;
            }
            $.each($("#original .label__checkbox:checked").parents(".invoice_item"), function (i,v) {
                let item = {
                    id : $(v).data('id'),
                    qty : parseFloat($(v).find('.qty').text()),
                    tax : parseFloat($(v).find('.tax').text()),
                    h_fee : parseFloat($(v).find('.h_fee').text()),
                    d_method :$(v).find('#d_method').val(),
                    d_fee : parseFloat($(v).find('.d_fee').text())
                };

                item_data.push(item);
            });
            console.log(item_data);
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to create new invoice",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, create it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('admin.delivery.request.invoice.do')}}",
                        method: "POST",
                        dataType: "JSON",
                        data: {
                            id: "{{$data['dr']->id}}",
                            data: item_data,
                            total: $("#grand_total").text()
                        },
                        success: function (data) {
                            console.log(data);
                            if(data.type === 'error'){
                                Swal.fire(
                                    'Invoice cannot be created',
                                    data.msg,
                                    'error'
                                );
                            }else{
                                Swal.fire(
                                    'Invoice created!',
                                    'Invoice has been created successfully.',
                                    'success'
                                );
                            }
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    })
                }
            });
        });
        
        $(document).on('click',"#btn-payment",function () {
            let invoice_no = $(this).parents('tr').find('td#invoice_no').data('invoice_no');
            $('#modal-payment #model_title').text("Payment Processing for Invoice - " + invoice_no);
            $('#modal-payment #invoice_no').text(invoice_no);
            $.ajax({
                url: "{{route('admin.invoice.items.get')}}",
                method: "GET",
                dataType: "JSON",
                data:{
                    id: $(this).data('id')
                },
                success: function (data) {
                    console.log(data);
                    let grand_total = 0;
                    $('#modal-payment').find("#item-container").html("");
                    $.each(data, function (i,v) {
                        let status = "{{\App\InvoiceItem::CUSTOMER_PAID}}";
                        let boo = v.status >= status;
                        $('#modal-payment').find("#item-container").append('<tr class="invoice_item" data-id="'+v.id+'">' +
                            '                                                <td>' +
                            '                                                    <div class="center">' +
                            '                                                        <label class="label">' +( boo ?
                                '                                                        <input  class="label__checkbox" type="checkbox" checked="checked"/>' :
                                '                                                        <input  class="label__checkbox" type="checkbox" />') +
                            '                                                           <span class="label__text">' +
                            '                                                               <span class="label__check">' +
                            '                                                                   <i class="fa fa-check icon"></i>' +
                            '                                                               </span>' +
                            '                                                           </span>' +
                            '                                                        </label>' +
                            '                                                    </div>' +
                            '                                                </td>'+
                            '                                                <td class="no">'+i+1+'</td>' +
                            '                                                <td class="text-left">' +
                            '                                                    <h3>'+v.dr_items.product_name+' - '+v.dr_items.product_code+'</h3>' +
                            '                                                    <p>'+v.dr_items.description+'</p>' +
                            '                                                    <a href="'+v.dr_items.product_url+'" target="_blank" class="hidden-print" >'+v.dr_items.product_url+'</a>' +
                            '                                                    <p>'+v.dr_items.suppliers.name+' - '+v.dr_items.seller_name+' </p>' +
                            '                                                </td>' +
                            '                                                <td class="unit">'+v.amount.toFixed(2)+'</td>' +
                            '                                                <td class="qty">'+v.qty+'</td>' +
                            '                                                <td class="tax">'+v.tax+'</td>' +
                            '                                                <td class="h_fee">'+v.handling_fee+'</td>' +
                            '                                                <td class="d_method"></td>' +
                            '                                                <td class="d_fee">'+v.delivery_cost+'</td>' +
                            '                                                <td class="total"</td>' +
                            '                                            </tr>');
                    });
                    $.each($('#modal-payment').find(".invoice_item"), function (i,v) {
                        console.log($(v).find('.unit').text());
                        /*let price = parseFloat($(v).find('.unit').text()).toFixed(2);*/
                        /*let qty = parseFloat($(v).find('.qty').text());*/
                        let tax = parseFloat($(v).find('.tax').text());
                        let h_fee = parseFloat($(v).find('.h_fee').text());
                        let d_fee = parseFloat($(v).find('.d_fee').text());
                        let tax_n_fee = parseFloat(tax+ h_fee +d_fee);
                        /*let price_n_qty = parseFloat(price * qty);*/
                        grand_total += (tax_n_fee);
                        let total = parseFloat(tax_n_fee).toFixed(2);
                        console.log(total);
                        console.log(tax_n_fee);
                        $(v).find('.total').text(total);
                    });
                    let del_cost = parseFloat($("#del_cost").text());
                    $('#modal-payment').find("#del_cost").text(del_cost.toFixed(2));
                    $('#modal-payment').find("#sub_total").text(grand_total.toFixed(2));
                    $('#modal-payment').find("#grand_total").text((grand_total).toFixed(2));
                    $('#modal-payment').modal('show');
                }
                ,error: function (error) {
                    console.log(error);
                }
            });
        });

        $(document).on('click',"#btn-view",function () {
            let invoice_no = $(this).parents('tr').find('td#invoice_no').data('invoice_no');
            $('#modal-xl #model_title').text(invoice_no);
            $('#modal-xl #invoice_no').text(invoice_no);
            $.ajax({
                url: "{{route('admin.invoice.items.get')}}",
                method: "GET",
                dataType: "JSON",
                data:{
                    id: $(this).data('id')
                },
                success: function (data) {
                    console.log(data);
                    let grand_total = 0;
                    $('#modal-xl').find("#item-container").html("");
                    $.each(data, function (i,v) {
                        $('#modal-xl').find("#item-container").append('<tr class="invoice_item" data-id="'+v.id+'">' +
                            '                                                <td>' +
                            '                                                    <div class="center">' +
                            '                                                        <label class="label">' +
                            '                                                        <input  class="label__checkbox" type="checkbox" checked="checked"/>' +
                            '                                                           <span class="label__text">' +
                            '                                                               <span class="label__check">' +
                            '                                                                   <i class="fa fa-check icon"></i>' +
                            '                                                               </span>' +
                            '                                                           </span>' +
                            '                                                        </label>' +
                            '                                                    </div>' +
                            '                                                </td>'+
                            '                                                <td class="no">'+i+1+'</td>' +
                            '                                                <td class="text-left">' +
                            '                                                    <h3>'+v.dr_items.product_name+' - '+v.dr_items.product_code+'</h3>' +
                            '                                                    <p>'+v.dr_items.description+'</p>' +
                            '                                                    <a href="'+v.dr_items.product_url+'" target="_blank" class="hidden-print" >'+v.dr_items.url+'</a>' +
                            '                                                    <p>'+v.dr_items.suppliers.name+' - '+v.dr_items.seller_name+' </p>' +
                            '                                                </td>' +
                            '                                                <td class="tax">'+v.tax+'</td>' +
                            '                                                <td class="h_fee">'+v.handling_fee+'</td>' +
                            '                                                <td class="d_method"></td>' +
                            '                                                <td class="d_fee">'+v.delivery_cost+'</td>' +
                            '                                                <td class="total"</td>' +
                            '                                            </tr>');
                    });
                    $.each($('#modal-xl').find(".invoice_item"), function (i,v) {
                        console.log($(v).find('.unit').text());
                        /*let price = parseFloat($(v).find('.unit').text()).toFixed(2);
                        let qty = parseFloat($(v).find('.qty').text());*/
                        let tax = parseFloat($(v).find('.tax').text());
                        let h_fee = parseFloat($(v).find('.h_fee').text());
                        let d_fee = parseFloat($(v).find('.d_fee').text());
                        let tax_n_fee = parseFloat(tax+ h_fee +d_fee);
                     /*   let price_n_qty = parseFloat(price * qty);*/
                        grand_total += (tax_n_fee);
                        let total = parseFloat(tax_n_fee).toFixed(2);
                        console.log(total);
                        console.log(tax_n_fee);
                        $(v).find('.total').text(total);
                    });
                    /*let del_cost = parseFloat($("#del_cost").text());
                    $('#modal-xl').find("#del_cost").text(del_cost.toFixed(2));
                    $('#modal-xl').find("#sub_total").text(grand_total.toFixed(2));*/
                    $('#modal-xl').find("#grand_total").text((grand_total).toFixed(2));
                    $('#modal-xl').modal('show');
                }
                ,error: function (error) {
                    console.log(error);
                }
            });
        });

        $(document).on('click',"#process_delivery_receive",function () {
            let invoice_item_data = [];
            if ($("#modal-xl").find(".label__checkbox:checked").parents(".invoice_item").length < 1){
                toastr.error('You don\'t have any items selected.');
                return false;
            }

            $.each($("#modal-xl").find(".label__checkbox:checked").parents(".invoice_item"), function (i,v) {
                let item = {
                    id : $(v).data('id'),
                    tax : parseFloat($(v).find('.tax').text()),
                    h_fee : parseFloat($(v).find('.h_fee').text()),
                    d_method :1,
                    d_fee : parseFloat($(v).find('.d_fee').text())
                };

                invoice_item_data.push(item);
            });
            console.log(invoice_item_data);
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to process the invoice to delivery receive",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{route('admin.delivery.receive.create.do')}}",
                        method: "POST",
                        dataType: "JSON",
                        data: {
                            id: "{{$data['dr']->id}}",
                            data: invoice_item_data,
                            invoice_no:   $('#modal-xl #invoice_no').text()
                        },
                        success: function (data) {
                            console.log(data);
                            if(data.type === 'error'){
                                Swal.fire(
                                    'Delivery cannot be created',
                                    data.msg,
                                    'error'
                                );
                            }else{
                                Swal.fire(
                                    'New Delivery added!',
                                    'Invoice has been added for Delivery Receive.',
                                    'success'
                                );

                            }
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);

                        },
                        error: function (error) {
                            console.log(error);
                        }
                    })
                }
            });
        });

        $(document).on('click',"#btn-purchase-view", function () {
            let purchasingId = $(this).data('id');
            $.ajax({
                url: "{{route('admin.purchasing.items.get')}}",
                method: "GET",
                dataType: "JSON",
                data: {
                    id: purchasingId
                },
                success: function (data) {
                    console.log(data);
                    let grand_total = 0;
                    $('#modal-purchasing').find("#item-container").html("");
                    $('#modal-purchasing').find("#update_purchase").attr("data-purchasingId", purchasingId);
                    $.each(data, function (i, v) {
                        let status = "{{\App\PurchasingItem::PURCHASED}}";
                        let boo = v.status >= status;
                        let reference = v.reference ? v.reference : '';
                        let tracking_no = v.tracking_no ? v.tracking_no : '';
                        let expected_delivery_date = v.expected_delivery_date ? v.expected_delivery_date : '';
                        $('#modal-purchasing').find("#item-container").append('<tr class="invoice_item" data-id="' + v.id + '">' +
                            '                                                <td>' +
                            '                                                    <div class="center">' +
                            '                                                        <label class="label">' +( boo ?
                                '                                                        <input  class="label__checkbox" type="checkbox" checked="checked"/>' :
                                '                                                        <input  class="label__checkbox" type="checkbox" />') +
                            '                                                           <span class="label__text">' +
                            '                                                               <span class="label__check">' +
                            '                                                                   <i class="fa fa-check icon"></i>' +
                            '                                                               </span>' +
                            '                                                           </span>' +
                            '                                                        </label>' +
                            '                                                    </div>' +
                            '                                                </td>' +
                            '                                                <td class="no">' + (i + 1) + '</td>' +
                            '                                                <td class="text-left">' +
                            '                                                    <h3>' + v.invoice_items.dr_items.product_name + ' - ' + v.invoice_items.dr_items.product_code + '</h3>' +
                                                                                '<div class="form-group">'+
                            '                                                        <label>Reference</label>'+
                                '                                                    <div class="input-group input-group-sm">'+
                                '                                                       <input class="form-control form-control-navbar reference" type="text" placeholder="Reference" autocomplete="off" value="'+reference+'">' +
                                '                                                    </div>' +
                            '                                                    </div>'+
                            '                                                    <div class="form-group">'+
                            '                                                    <label>Expected Delivery Date</label>'+
                                '                                                    <div class="input-group input-group-sm">' +
                                '                                                       <input class="form-control form-control-navbar date" type="date" placeholder="Date" autocomplete="off" value="'+expected_delivery_date+'">' +
                                '                                                    </div>' +
                            '                                                    </div>'+
                            '                                                    <div class="form-group">'+
                            '                                                    <label>Tracking No</label>'+
                            '                                                    <div class="input-group input-group-sm">' +
                            '                                                       <input class="form-control form-control-navbar tracking_no" type="text" placeholder="Tracking No" autocomplete="off" value="'+tracking_no+'">' +
                            '                                                    </div>' +
                            '                                                    </div>'+
                            '                                                </td>' +
                            '                                                <td class="unit">' + v.invoice_items.amount.toFixed(2) + '</td>' +
                            '                                                <td class="qty">' + v.invoice_items.qty + '</td>' +
                            '                                                <td class="tax">' + v.invoice_items.tax + '</td>' +
                            '                                                <td class="h_fee">' + v.invoice_items.handling_fee + '</td>' +
                            '                                                <td class="d_fee">' + v.invoice_items.delivery_cost + '</td>' +
                            '                                                <td class="total"</td>' +
                            '                                            </tr>');
                    });
                    $.each($('#modal-purchasing').find(".invoice_item"), function (i, v) {
                        console.log($(v).find('.unit').text());
                        let price = parseFloat($(v).find('.unit').text()).toFixed(2);
                        let qty = parseFloat($(v).find('.qty').text());
                        let tax = parseFloat($(v).find('.tax').text());
                        let h_fee = parseFloat($(v).find('.h_fee').text());
                        let d_fee = parseFloat($(v).find('.d_fee').text());
                        let tax_n_fee = parseFloat(tax + h_fee + d_fee);
                        let price_n_qty = parseFloat(price * qty);
                        grand_total += (tax_n_fee + price_n_qty);
                        let total = parseFloat(tax_n_fee + price_n_qty).toFixed(2);
                        console.log(price, qty, tax, h_fee, tax_n_fee);
                        console.log(total);
                        console.log(tax_n_fee);
                        $(v).find('.total').text(total);
                    });
                    $('#modal-purchasing').modal('show');
                }, error: function (error) {
                    console.log(error);
                }
            });
        });

        $("#update_purchase").on('click',function () {
            let purchasingId = $(this).data('purchasingid');
            let item_data = [];
            if ($("#modal-purchasing").find(".label__checkbox:checked").parents(".invoice_item").length < 1){
                toastr.error('You don\'t have any items selected.');
                return false;
            }
            let count = 0;
            let ref = $("#modal-purchasing").find(".label__checkbox:checked").parents(".invoice_item").find('.reference');
            $.each(ref, function (i,v) {
              if ($(v).val() != ''){
                  count++;
              }
            });


            $.each($("#modal-purchasing .label__checkbox:checked").parents(".invoice_item"), function (i,v) {
                let item = {
                    id : $(v).data('id'),
                    price : parseFloat($(v).find('.unit').text()).toFixed(2),
                    qty : parseFloat($(v).find('.qty').text()),
                    tax : parseFloat($(v).find('.tax').text()),
                    h_fee : parseFloat($(v).find('.h_fee').text()),
                    d_fee : parseFloat($(v).find('.d_fee').text()),
                    reference : $(v).find('.reference').val(),
                    date : $(v).find('.date').val(),
                    tracking_no : $(v).find('.tracking_no').val()
                };

                item_data.push(item);
            });
            console.log(item_data);
            console.log(purchasingId);
            console.log(ref.length, count);
            if (count === ref.length){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to complete the purchase",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Update it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{route('admin.purchasing.update.do')}}",
                            method: "POST",
                            dataType: "JSON",
                            data: {
                                id: purchasingId,
                                data: item_data,
                            },
                            success: function (data) {
                                console.log(data);
                                if(data.type === 'error'){
                                    Swal.fire(
                                        'Invoice cannot be created',
                                        data.msg,
                                        'error'
                                    );
                                }else{
                                    Swal.fire(
                                        'Purchasing updated!',
                                        'Purchasing has been updated successfully.',
                                        'success'
                                    );
                                }
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1000);
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        })
                    }
                });
            }else{
                toastr.error('Please provide a reference number for purchase item!');
            }
        });
    </script>
    @endsection
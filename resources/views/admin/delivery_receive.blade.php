@extends('layouts.admin_app')
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
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
@stop
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Delivery receive</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Delivery Receive</li>
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
                            <th>Invoice Number</th>
                            <th>References</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($delivery_receive as $del_receive)
                                <tr>
                                    <td>{{$del_receive->id}}</td>
                                    <td>{{$del_receive->invoice_no}}</td>
                                    <td>{{$del_receive->reference}}</td>
                                    <td>{{$del_receive->status == \App\Purchasing::PURCHASED ? 'Purchased' :
                                            ($del_receive->status == \App\Purchasing::CANCELED ? 'Canceled' :
                                                ($del_receive->status == \App\Purchasing::COMPLETED ? 'Completed' :
                                                    ($del_receive->status == \App\Purchasing::PENDING ? 'Pending' :
                                                        ($del_receive->status == \App\Purchasing::PROCESSING ? 'Processing' :
                                                            ($del_receive->status == \App\Purchasing::PARTIAL_PURCHASED ? 'Partial Purchased' :
                                                                ($del_receive->status == \App\Purchasing::DELIVERED ? 'Delivered to warehouse' : ''))))))}}</td>
                                    <td>{{$del_receive->created_at}}</td>
                                    <td><a href="#" class="btn btn-sm btn-success" id="btn-purchasing-view" data-id="{{$del_receive->id}}"><i class="fas fa-eye"></i> View Details</a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Invoice Number</th>
                            <th>References</th>
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
                    <h4 class="modal-title" id="model_title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="invoice">

                        <div class="toolbar d-print-none">
                            <h2 class="text-left">Delivery Receive</h2>
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
                        <button type="button" class="btn btn-primary" id="update_purchase">Items Delivered to warehouse</button>
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
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable();
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
        $(document).on('click',"#btn-purchasing-view", function () {
            let purchasingId = $(this).data('id');
            $.ajax({
                url: "{{route('admin.delivery.receive.items.get')}}",
                method: "GET",
                dataType: "JSON",
                data: {
                    id: purchasingId
                },
                success: function (data) {
                    console.log(data);
                    let grand_total = 0;
                    $('#modal-receiving').find("#item-container").html("");
                    $('#modal-receiving').find("#update_purchase").attr("data-purchasingId", purchasingId);
                    $.each(data, function (i, v) {
                        let status = "{{\App\PurchasingItem::DELIVERED}}";
                        let boo = v.status >= status;
                        //todo : add missing details to the view
                        let reference = v.reference ? v.reference : '';
                        let tracking_no = v.tracking_no ? v.tracking_no : '';
                        let expected_delivery_date = v.expected_delivery_date ? v.expected_delivery_date : '';
                        $('#modal-receiving').find("#item-container").append('<tr class="invoice_item" data-id="' + v.id + '">' +
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
                            '                                                    <div class="form-group">'+
                            '                                                    <label>Delivered Date</label>'+
                            '                                                    <div class="input-group input-group-sm">' +
                            '                                                       <input class="form-control form-control-navbar date" type="date" placeholder="Date" autocomplete="off" value="'+expected_delivery_date+'">' +
                            '                                                    </div>' +
                            '                                                    </div>'+
                            '                                                </td>' +
                            '                                                <td class="qty">' + v.invoice_items.qty + '</td>' +
                            '                                                <td class="tax">' + v.invoice_items.tax + '</td>' +
                            '                                                <td class="h_fee">' + v.invoice_items.handling_fee + '</td>' +
                            '                                                <td class="d_fee">' + v.invoice_items.delivery_cost + '</td>' +
                            '                                                <td class="total"</td>' +
                            '                                            </tr>');
                    });
                    $.each($('#modal-receiving').find(".invoice_item"), function (i, v) {
                        console.log($(v).find('.unit').text());
                     /*   let price = parseFloat($(v).find('.unit').text()).toFixed(2);*/
                        let qty = parseFloat($(v).find('.qty').text());
                        let tax = parseFloat($(v).find('.tax').text());
                        let h_fee = parseFloat($(v).find('.h_fee').text());
                        let d_fee = parseFloat($(v).find('.d_fee').text());
                        let tax_n_fee = parseFloat(tax + h_fee + d_fee);
                      /*  let price_n_qty = parseFloat(price * qty);*/
                        grand_total += (tax_n_fee);
                        let total = parseFloat(tax_n_fee).toFixed(2);
                       /* console.log(price, qty, tax, h_fee, tax_n_fee);*/
                        console.log(total);
                        console.log(tax_n_fee);
                        $(v).find('.total').text(total);
                    });
                    $('#modal-receiving').modal('show');
                }, error: function (error) {
                    console.log(error);
                }
            });
        });

        $("#update_purchase").on('click',function () {
            let purchasingId = $(this).data('purchasingid');
            let item_data = [];
            if ($("#modal-receiving").find(".label__checkbox:checked").parents(".invoice_item").length < 1){
                toastr.error('You don\'t have any items selected.');
                return false;
            }
            let count = 0;
            let dateRef = $("#modal-receiving").find(".label__checkbox:checked").parents(".invoice_item").find('.date');
            $.each(dateRef, function (i,v) {
                if ($(v).val() != ''){
                    count++;
                }
            });


            $.each($("#modal-receiving .label__checkbox:checked").parents(".invoice_item"), function (i,v) {
                let item = {
                    id : $(v).data('id'),
                   /* qty : parseFloat($(v).find('.qty').text()),*/
                    qty: 10,
                    tax : parseFloat($(v).find('.tax').text()),
                    h_fee : parseFloat($(v).find('.h_fee').text()),
                    d_fee : parseFloat($(v).find('.d_fee').text()),
                    date : $(v).find('.date').val(),
                };

                item_data.push(item);
            });
            console.log(item_data);
            console.log(purchasingId);
            if (dateRef.length == count){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to complete the Delivery Receive",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Complete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{route('admin.delivery.receive.update.do')}}",
                            method: "POST",
                            dataType: "JSON",
                            data: {
                                id: purchasingId,
                                data: item_data,
                                type: 'receiving'
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
                                        'Delivery updated!',
                                        'Delivery has been updated successfully.',
                                        'success'
                                    );

                                }
                             /*   setTimeout(function() {
                                    window.location.reload();
                                }, 1000);*/

                            },
                            error: function (error) {
                                console.log(error);
                            }
                        })
                    }
                });
            }else{
                toastr.error('Please provide a Delivered date for purchase item!');
            }
        });
    </script>
@stop

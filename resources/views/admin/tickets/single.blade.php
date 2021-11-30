@extends('layouts.admin_app')
@section('custom_css')
    <style>
        .swal2-popup{
            font-size: 1.5rem !important;
        }

        .chat{
            margin-top: auto;
            margin-bottom: auto;
        }
        .card.chat-card{
            height: 750px;
            border-radius: 15px !important;
            background-color: rgba(0,0,0,0.4) !important;
        }
        .contacts_body{
            padding:  0.75rem 0 !important;
            overflow-y: auto;
            white-space: nowrap;
        }
        .msg_card_body{
            overflow-y: auto;
        }
        .chat-card .card-header{
            border-radius: 15px 15px 0 0 !important;
            border-bottom: 0 !important;
        }
        .chat-card .card-footer{
            border-radius: 0 0 15px 15px !important;
            border-top: 0 !important;
        }
        .container{
            align-content: center;
        }
        .search{
            border-radius: 15px 0 0 15px !important;
            background-color: rgba(0,0,0,0.3) !important;
            border:0 !important;
            color:white !important;
        }
        .search:focus{
            box-shadow:none !important;
            outline:0px !important;
        }
        .type_msg{
            background-color: rgba(0,0,0,0.3) !important;
            border:0 !important;
            color:white !important;
            height: 60px !important;
            overflow-y: auto;
        }
        .type_msg:focus{
            box-shadow:none !important;
            outline:0px !important;
        }
        .attach_btn{
            border-radius: 15px 0 0 15px !important;
            background-color: rgba(0,0,0,0.3) !important;
            border:0 !important;
            color: white !important;
            cursor: pointer;
        }
        .send_btn{
            border-radius: 0 15px 15px 0 !important;
            background-color: rgba(0,0,0,0.3) !important;
            border:0 !important;
            color: white !important;
            cursor: pointer;
        }
        .search_btn{
            border-radius: 0 15px 15px 0 !important;
            background-color: rgba(0,0,0,0.3) !important;
            border:0 !important;
            color: white !important;
            cursor: pointer;
        }
        .contacts{
            list-style: none;
            padding: 0;
        }
        .contacts li{
            width: 100% !important;
            padding: 5px 10px;
            margin-bottom: 15px !important;
        }
        .chat-card .active{
            background-color: rgba(0,0,0,0.3);
        }
        .user_img{
            height: 70px;
            width: 70px;
            border:1.5px solid #f5f6fa;

        }
        .user_img_msg{
            height: 40px;
            width: 40px;
            border:1.5px solid #f5f6fa;

        }
        .img_cont{
            position: relative;
            height: 70px;
            width: 70px;
        }
        .img_cont_msg{
            height: 40px;
            width: 40px;
        }
        .online_icon{
            position: absolute;
            height: 15px;
            width:15px;
            background-color: #4cd137;
            border-radius: 50%;
            bottom: 0.2em;
            right: 0.4em;
            border:1.5px solid white;
        }
        .offline{
            background-color: #c23616 !important;
        }
        .user_info{
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 15px;
        }
        .user_info span{
            font-size: 20px;
            color: white;
        }
        .user_info p{
            font-size: 10px;
            color: rgba(255,255,255,0.6);
        }
        .video_cam{
            margin-left: 50px;
            margin-top: 5px;
        }
        .video_cam span{
            color: white;
            font-size: 20px;
            cursor: pointer;
            margin-right: 20px;
        }
        .msg_cotainer{
            margin-top: auto;
            margin-bottom: auto;
            margin-left: 10px;
            border-radius: 25px;
            background-color: #82ccdd;
            padding: 10px;
            position: relative;
        }
        .msg_cotainer_send{
            margin-top: auto;
            margin-bottom: auto;
            margin-right: 10px;
            border-radius: 25px;
            background-color: #78e08f;
            padding: 10px;
            position: relative;
        }
        .msg_time{
            /*  position: absolute;
              left: 0;
              bottom: -15px;*/
            color: rgba(255,255,255,0.5);
            font-size: 10px;
            margin-left: 20px;
        }
        .msg_time_send{
            /* position: absolute;
             right:0;
             bottom: -15px;*/
            color: rgba(255,255,255,0.5);
            font-size: 10px;
            float: right;
            margin-right: 20px;
        }
        .msg_head{
            position: relative;
        }
        .chat-card #action_menu_btn{
            position: absolute;
            right: 10px;
            top: 10px;
            color: white;
            cursor: pointer;
            font-size: 20px;
        }
        .chat-card .action_menu{
            z-index: 1;
            position: absolute;
            padding: 15px 0;
            background-color: rgba(0,0,0,0.5);
            color: white;
            border-radius: 15px;
            top: 30px;
            right: 15px;
            display: none;
        }
        .chat-card .action_menu ul{
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .action_menu ul li{
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 5px;
        }
        .action_menu ul li i{
            padding-right: 10px;

        }
        .action_menu ul li:hover{
            cursor: pointer;
            background-color: rgba(0,0,0,0.2);
        }
        @media(max-width: 576px){
            .contacts_card{
                margin-bottom: 15px !important;
            }
        }
    </style>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Single Ticket view</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Ticket</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Support Ticket #{{$ticket->ticket_id}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card chat-card" style="width: 100%">
                                <div class="card-header msg_head" style="background: #343a40;">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="http://www.iconarchive.com/download/i69390/aha-soft/free-large-boss/Admin.ico" class="rounded-circle user_img">
                                            <span class="online_icon"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>Chat with User</span>
                                            <p id="msg_count"></p>
                                        </div>
                                        {{-- <div class="video_cam">
                                             <span><i class="fas fa-video"></i></span>
                                             <span><i class="fas fa-phone"></i></span>
                                         </div>--}}
                                    </div>
                                    <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                                    <div class="action_menu">
                                        <ul>
                                            <li><i class="fas fa-user-circle"></i> View profile</li>
                                            <li><i class="fas fa-users"></i> Add to close friends</li>
                                            <li><i class="fas fa-plus"></i> Add to group</li>
                                            <li><i class="fas fa-ban"></i> Block</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body msg_card_body">

                                </div>
                                <div class="card-footer">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                                        </div>
                                        <textarea name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
                                        <div class="input-group-append">
                                            <span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@stop
@section('custom_js')
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}" ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        let pusher = new Pusher('6fe1431f334fb2c4b416', {
            cluster: 'ap2',
            forceTLS: true
        });

        let channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            $.ajax({
                url: "{{route('admin.ticket.messages.get')}}",
                method: "POST",
                cache: false,
                data: {
                    ticket: {{$ticket->id}}
                },
                success: function (data) {
                    $(".msg_card_body").html(data);
                    $('.msg_card_body').animate({scrollTop: $('.msg_card_body').prop('scrollHeight')});
                    $("#msg_count").html($(".msg_card_body .msg").length + " Messages");
                },
                error: function (error) {
                    console.log(error);
                }
            });
            /* alert(JSON.stringify(data));*/
        });
    </script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "{{route('admin.ticket.messages.get')}}",
                method: "POST",
                cache: false,
                data: {
                    ticket: {{$ticket->id}}
                },
                success: function (data) {
                    $(".msg_card_body").html(data);
                    $('.msg_card_body').animate({scrollTop: $('.msg_card_body').prop('scrollHeight')});
                    $("#msg_count").html($(".msg_card_body .msg").length + " Messages");
                },
                error: function (error) {
                    console.log(error);
                }
            });

            $(document).on('keyup','.type_msg', function (e) {
                let msg = $(this).val();

                if (e.keyCode == 13 && msg != ""){
                    $(this).val("");
                    $.ajax({
                        url: "{{route('admin.ticket.message.send')}}",
                        method: "POST",
                        cache: false,
                        data: {
                            message: msg,
                            ticket: {{$ticket->id}},
                            to: 4
                        },
                        success:function (data) {
                            console.log(data)
                        },
                        error: function (error) {
                            console.log(error)
                        }
                    })
                }
            })
        })
    </script>
@endsection
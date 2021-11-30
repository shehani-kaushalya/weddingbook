@extends('layouts.admin_app')
@section('custom_css')
    <style>
        .swal2-popup{
            font-size: 1.5rem !important;
        }

        .ticket-nav li a:hover, .ticket-nav li a.active{
            background-color: #5E5E5E !important;
            color: #fff !important;
        }

        .ticket-nav li p{
            width: 100%;
        }

        .ticket-nav li .badge{
            margin-right: 1rem;
            float: right;
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
                        <h1>Support Tickets</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Support Tickets</li>
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
                        {{--<div class="card-header">
                            <h3 class="card-title">All Support Tickets </h3>
                        </div>--}}
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 pagination-nav">

                                    <div class="form-group float-right" style="margin-right: 1rem">
                                        <label for="ticket_perpage">Per Page</label>
                                        <select id="ticket_perpage" class="form-control">
                                            <option>20</option>
                                            <option>40</option>
                                            <option>60</option>
                                        </select>
                                    </div>
                                    <div class="form-group float-right" style="margin-right: 1rem">
                                        <label for="ticket_status">Status</label>
                                        <select id="ticket_status" class="form-control">
                                            <option>ALL</option>
                                            @foreach(config('amax.ticket_status') as $key=>$status)
                                                @if(request()->get('status') == $status)
                                                    <option selected="selected" value="{{$status}}">{{$key}}</option>
                                                @else
                                                    <option value="{{$status}}">{{$key}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group float-right" style="margin-right: 1rem">
                                        <label for="ticket_priority">Priority</label>
                                        <select id="ticket_priority" class="form-control">
                                            <option value="ALL">ALL</option>
                                            @foreach(config('amax.ticket_priority') as $key=>$status)
                                                @if(request()->get('priority') == $status)
                                                    <option selected="selected" value="{{$status}}">{{$key}}</option>
                                                @else
                                                    <option value="{{$status}}">{{$key}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="float-right" style="margin-right: 1rem">
                                            @if($tickets->total() > $tickets->perPage())
                                                <label for="ticket_pagination">Pagination</label>
                                                {{ $tickets->onEachSide(5)->links() }}
                                            @endif


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <nav style=" border-radius: 1rem" class="ticket-nav">
                                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                            <!-- Add icons to the links using the .nav-icon class
                                                 with font-awesome or any other icon font library -->
                                            <li class="nav-item has-treeview">
                                                <a href="#" style="color: #5E5E5E; margin: 0;"  class="nav-link active">
                                                    <i class="far fa-flag"></i>
                                                    <p>
                                                        All Tickets <label class="badge badge-dark">{{$tickets->total()}}</label>
                                                    </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" style="color: #5E5E5E; margin: 0;" class="nav-link">
                                                    <i class="far fa-flag"></i>
                                                    <p>
                                                        Urgent Tickets <label class="badge badge-dark">0</label>
                                                    </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" style="color: #5E5E5E; margin: 0;" class="nav-link">
                                                    <i class="far fa-flag"></i>
                                                    <p>
                                                        Low Priority Tickets <label class="badge badge-dark">0</label>
                                                    </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" style="color: #5E5E5E; margin: 0;" class="nav-link">
                                                    <i class="far fa-flag"></i>
                                                    <p>
                                                        Medium Priority Tickets <label class="badge badge-dark">0</label>
                                                    </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" style="color: #5E5E5E; margin: 0;" class="nav-link">
                                                    <i class="far fa-flag"></i>
                                                    <p>
                                                        High Priority Tickets <label class="badge badge-dark">0</label>
                                                    </p>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        @foreach($tickets as $ticket)
                                            <div class="col-sm-12" style="border: 0.1em solid #cccccc; border-radius: 0.5em; padding-top: 0.5em; margin-bottom: 1em">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label style="width: 100%; text-align: center"> #{{$ticket->ticket_id}}</label>
                                                        <span style="width: 100%; font-size: 1em;" class="badge badge-pill badge-primary"> OPEN </span>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <h4 style="    margin-bottom: 0;">{{$ticket->title}}.  <span style="font-size: 0.6em; color: #869099;">{{$ticket->updated_at->diffForHumans()}}</span></h4>
                                                        <p style="color: #5E5E5E;">{{$ticket->description}}</p>
                                                    </div>
                                                </div>
                                                <div class="row" style="border-top: 1px solid #cccccc">
                                                    <div class="col-md-2" style="text-align: center;     font-size: 1.3em;">
                                                        <div class="row">
                                                            <div class="col-md-4" style="
                                                                    border-right: 1px solid #cccccc;
                                                                    display: flex;
                                                                    flex-direction: column;
                                                                    justify-content: center;
                                                                    align-items: center;
                                                                    height: 3rem;"><i style="text-shadow: 0 0 0 #000;
    -webkit-text-fill-color: white;
    -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: black" class="fas fa-thumbtack"></i></div>
                                                            <div class="col-md-4" style="display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 3rem;
    border-right: 1px solid #cccccc;"><i style="text-shadow: 0 0 0 #000;
    -webkit-text-fill-color: white;
    -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: black" class="fas fa-star"></i></div>
                                                            <div class="col-md-4" style="display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 3rem;
    border-right: 1px solid #cccccc;"><i style="text-shadow: 0 0 0 #000;
    -webkit-text-fill-color: white;
    -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: black" class="fas fa-info-circle"></i></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="display: flex; border-right: 1px solid #ccc;">
                                                       <div style="display: flex">
                                                           <img style="margin: auto" src="https://img.icons8.com/officel/2x/user.png" class="img-fluid img-thumbnail img-circle img-sm"/>
                                                       </div>
                                                        <div style="    display: flex;
    flex-direction: column;
    margin-left: 0.8rem;">
                                                            <span style="    font-size: 0.8rem;
    color: #C9C4C0;">Assignee</span>
                                                            <span style="    color: #5D626E;">{{$ticket->staff->first_name}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="display: flex; border-right: 1px solid #ccc;">
                                                        <div style="display: flex">
                                                            <img style="margin: auto" src="https://img.icons8.com/officel/2x/user.png" class="img-fluid img-thumbnail img-circle img-sm"/>
                                                        </div>
                                                        <div style="    display: flex;
    flex-direction: column;
    margin-left: 0.8rem;">
                                                            <span style="    font-size: 0.8rem;
    color: #C9C4C0;">Customer</span>
                                                            <span style="    color: #5D626E;">{{$ticket->customers->first_name}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="display: flex; border-right: 1px solid #ccc;">
                                                        <div style="    display: flex;
    flex-direction: column;
    margin-left: 0.8rem;">
                                                            <span style="    font-size: 0.8rem;
    color: #C9C4C0;">Priority Level</span>
                                                            <span style="    color: #5D626E;">
                                                                @foreach(config('amax.ticket_priority') as $key=>$status)

                                                                    @if($status == $ticket->priority)
                                                                        {{$key}}
                                                                    @endif
                                                                @endforeach
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="display: flex;
    align-items: center;">
                                                        <a href="{{route('admin.single.ticket.view',$ticket->id)}}" class="btn btn-sm btn-success"><i class="far fa-comments"></i> Start Chat <span class="badge badge-dark"> 0 </span></a>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                    <!-- /.card -->
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#ticket_priority").on('change', function () {
           var priority = $(this).val();
            if(document.location.href.indexOf('priority') > -1) {
                console.log('yes');
                var url = new URL(document.location.href);

                var query_string = url.search;

                var search_params = new URLSearchParams(query_string);
                search_params.set('priority', priority);
                url.search = search_params.toString();
                var new_url = url.toString();
                console.log(new_url);
              /*  var url = document.location.href+"&priority="+priority;*/
            }else{
                var new_url = document.location.href+"?priority="+priority;
            }
            document.location = new_url;
            console.log($(this).val());
        });

        $("#ticket_status").on('change', function () {
            var status = $(this).val();
            if(document.location.href.indexOf('status') > -1) {
                console.log('yes');
                var url = new URL(document.location.href);

                var query_string = url.search;

                var search_params = new URLSearchParams(query_string);
                search_params.set('status', status);
                url.search = search_params.toString();
                var new_url = url.toString();
                console.log(new_url);
                /*  var url = document.location.href+"&priority="+priority;*/
            }else{
                var new_url = document.location.href+"?status="+status;
            }
            document.location = new_url;
            console.log($(this).val());
        })
    </script>
@endsection
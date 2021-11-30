@extends('layouts.admin_app')
@section('custom_css')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<style type="text/css">
.overlay {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.7);
    transition: opacity 200ms;
    visibility: hidden;
    opacity: 0;
    display: none;
    z-index: 9;
}
.advetiesment-card {
    display: flex;
    flex-flow: column;
    justify-content: center;
    align-items: center;
    background-color: #ffffff;
    box-shadow: 0 1px 2px 0 rgb(255 235 232 / 15%);
    width: 100%;
    height: auto;
    border: 1px solid #c3c3c3;
    padding: 15px;
}
.advetiesment-card .advetiesment-card__slider {
    display: grid;
    position: relative;
    width: 100%;
    box-sizing: border-box;
    max-height: 198px;
    overflow: hidden;
}
.advetiesment-card .advetiesment-card__slider .day-block {
    position: absolute;
    top: 0;
    left: 15px;
    width: auto;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 400;
    color: #ffffff;
    background-color: #d68d17;
    font-size: 110pxpx;
    font-size: 11pxrem;
    padding: 0 10px;
}
.advetiesment-card .advetiesment-card__slider img {
    width: 100%;
    height: auto;
}
.advetiesment-card__content {
    display: grid;
    position: relative;
    width: 100%;
    box-sizing: border-box;
    padding: 10px 0;
}
.advetiesment-card__content .reviews-block {
    display: flex;
    padding: 0 15px;
    border-bottom: dashed 1px #D8D8D8;
    margin-bottom: 3px;
    text-align: left;
}
.advetiesment-card__content .reviews-block__icon {
    color: #FEBB00;
    font-size: 20px;
}
.advetiesment-card__content .reviews-block__text {
    font-size: 14px;
    margin-left: auto;
    font-weight: 400;
}
.advetiesment-card__content .location-block {
    display: inline-block;
    width: 100%;
    padding: 5px 15px;
}
.advetiesment-card__content .location-block span {
    display: block;
    width: 100%;
}

</style>
@stop
@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Advetiesments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Advetiesments</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Advetiesments List </h3>
                    </div>
                    <!-- /.card-header -->
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
                            <h5><i class="icon fas fa-check"></i> Succsess!</h5>
                            {!! session('success_message') !!}
                        </div>
                        @endif

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Vendor</th>
                                    <th>Payment Status</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($advetiesments as $key => $advetiesment) 
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td> {{ $advetiesment->title }} </td>
                                        <td> {{ $advetiesment->vendor->first_name }} {{ $advetiesment->vendor->last_name }} </td>
                                        <td> {{ ($advetiesment->is_paid === 1) ? 'PAID' : 'PENDING' }} </td>
                                        <td> {{ ($advetiesment->status === \App\Advertisment::ACTIVE) ? 'ACTIVE (PUBLISHED)' : 'PENDING' }} </td>
                                        <td style="text-align:end;"> 
                                            <a href="#" data-toggle="modal" data-target="#preview-advetiesment-{{ $advetiesment->id }}" class="btn btn-info">
                                                View </a>
                                            <a href="{{ route('admin.advetiesments.delete', $advetiesment->id) }}" class="btn btn-danger">
                                                Delete </a>

                                            <div class="modal fade" id="preview-advetiesment-{{ $advetiesment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="advetiesment-card">
                                                                <div class="advetiesment-card__slider">
                                                                    <div class="day-block">New</div>
                                                                    <img src="{{asset($advetiesment->image)}}" />
                                                                </div>

                                                                <div class="advetiesment-card__content">
                                                                    <div class="reviews-block">
                                                                        <span class="reviews-block__icon">*****</span>
                                                                        <span class="reviews-block__text">{{ $advetiesment->vendor->reviews->count() }} Reviews</span>
                                                                    </div>

                                                                    <div class="location-block text-left">
                                                                        <span class="s5">{{ $advetiesment->title }}</span>
                                                                        <span class="s7"><small>{{ $advetiesment->content }}</small></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            @if($advetiesment->status !== \App\Advertisment::ACTIVE)
                                                                <a href="{{ route('admin.advetiesments.approve', $advetiesment->id) }}" class="btn btn-primary">Approve</a>
                                                            @else
                                                                <a href="{{ route('admin.advetiesments.unpublish', $advetiesment->id) }}" class="btn btn-danger">Un Publish</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            <!-- /.card -->
            </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
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

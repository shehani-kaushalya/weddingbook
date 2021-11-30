@extends('layouts.admin_app')
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@stop
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Purchase Requests</h1>
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
                <div class="card-header">
                    <h3 class="card-title">Title</h3>
                </div>
                <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                              <th>#</th>
                              <th>Customer</th>
                              <th>Status</th>
                              <th>Requested Date</th>
                              <th>Action</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($data['prs'] as $pr)
                              <tr>
                                  <td>{{$pr->id}}</td>
                                  <td>{{$pr->customers->first_name}} {{$pr->customers->last_name}}</td>
                                  <td>
                                      {{$pr->status == \App\PurchaseRequest::PENDING ? "Pending" :
                                      ( $pr->status == \App\PurchaseRequest::APPROVED ? 'Approved' :
                                        ( $pr->status == \App\PurchaseRequest::PROCESSING ? 'Processing' :'Decline'))}}
                                  </td>
                                  <td>{{$pr->created_at}}</td>
                                  <td><a href="{{route('admin.purchase.request.single.view',$pr->id)}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> View Details</a> </td>
                              </tr>
                          @endforeach
                          </tbody>
                          <tfoot>
                          <tr>
                              <th>#</th>
                              <th>Customer</th>
                              <th>Status</th>
                              <th>Requested Date</th>
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
    @stop

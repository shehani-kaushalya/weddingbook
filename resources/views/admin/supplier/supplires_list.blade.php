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
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard 123</li>
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

          <!-- /.card -->

          <div class="card">
            <div class="card-header">

              <h3 class="card-title">Suppliers List  </h3>
              <a href="suppliers/add" class="btn btn-primary pull-right" style="text-align: right; float: right; margin-right: 20px; margin-top: 10px;" > Add Supplier  </a>

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
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    {!! session('success_message') !!}
                </div>
              @endif


              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Logo</th>
                  <th>Supplier Name</th>
                  <th>Website</th>
                  <th>Status</th>
                  <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>

                  @php
                    $i = 1
                  @endphp
                @foreach($suppliers as $supplier)
                  <tr>
                    <td> {{ $i++ }} </td>
                    <td>
                      @if($supplier->logo == '')
                        <img src="{{ config('app.asset_url') }}/admin/dist/img/avatar5.png" class="img-circle elevation-2" width="32" style="width:32px; height:32px;" alt="Supplier Image">
                      @else
                        <img src="{{ config('app.asset_url') }}/supplier/{{ $supplier->logo }}"  class="img-circle elevation-2" width="32" style="width:32px; height:32px;" alt="Supplier Image">
                      @endif


                    </td>
                    <td> {{ $supplier->name }} </td>
                    <td> {{ $supplier->website }} </td>
                    <td>
                      @if($supplier->status == '100')
                        Active
                      @else
                        Inactive
                      @endif
                    </td>
                    <td style="white-space: nowrap;">
                      <a href="suppliers/{{ $supplier->id }}" class="btn btn-primary"> Edit </a>
                      {{-- <a href="{{ $supplier->id }}" class="btn btn-danger"> Delete </a> --}}

                        <button class="btn btn-danger btn-primary" data-href="suppliers/delete/{{ $supplier->id }}" data-toggle="modal" data-target="#supplier-delete">
                            Delete Supplier
                        </button>
                    </td>
                  </tr>
                @endforeach


                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Logo</th>
                  <th>Supplier Name</th>
                  <th>Website</th>
                  <th>Status</th>
                  <th>&nbsp;</th>
                </tr>
                </tfoot>
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


    <div class="modal fade" id="supplier-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Supplier Management</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <p>Are you sure you want to delete this supplier?</p>
              <p class="debug-url"></p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            <a href="" id="cmPrimary" class="btn bg-gradient-success btn-sm cmPrimary">Confirm Delete</a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


@stop


@section('custom_js')

<script src="{{ config('app.asset_url') }}/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ config('app.asset_url') }}/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });

    $('#supplier-delete').on('show.bs.modal', function(e) {
        $(this).find('.cmPrimary').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

@stop

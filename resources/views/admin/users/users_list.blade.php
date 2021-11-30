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
                      <h1 class="m-0 text-dark">Users</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Users</li>
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
              <h3 class="card-title">User List</h3>  
              <a href="{{ route('users.add') }}" class="btn btn-primary pull-right" style="text-align: right; float: right; margin-right: 20px; margin-top: 10px;" > Add Users  </a>
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
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>&nbsp;</th>
                </tr>
                </thead>                
                <tbody>
                
                @php
                  $i = 1
                @endphp
                @foreach($list_users as $user)
                    
                    <tr>

                      <td> {{ $i++ }} </td>
                      <td> {{ $user->first_name }} {{ $user->last_name }} </td>
                      <td> {{ $user->email }} </td> 
                      <td>
                        @if($user->status == '100')        
                          Active 
                        @else
                          Inactive 
                        @endif 
                      </td> 
                      @if($user->email == Session::get('user_email'))   
                        <td>                    
                        <a href="{{ route('users', $user->id) }}" class="btn btn-primary"> Edit </a>  
                        <!-- <a href="users/{{ $user->id }}" class="btn btn-block btn-danger"> Delete </a> -->
                        <a href="#" class="btn btn-danger" disabled> Delete </a>            
                        </td>
                        
                      @else
                        <td>                    
                          &nbsp;              
                        </td>
                      @endif

                    </tr>
                 
                @endforeach

                
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Photo</th>
                  <th>Full Name</th>
                  <th>Email</th>
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
</script>

@stop

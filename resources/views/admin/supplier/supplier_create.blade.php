@extends('layouts.admin_app')
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
              <h3 class="card-title">Supplier >> Add </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        {!! session('success_message') !!}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    </div>
                    <br />
                @endif

                <form name="supplier_data" id="supplier_data" method="post" action="{{ route('supplier.edit') }}"  enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 control-label">Supplier Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" required value="" id="name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="website" class="col-sm-2 control-label">Website (URL)</label>
                            <div class="col-sm-10">
                                <input type="text" name="website" required value="" id="website" class="form-control" placeholder="http://wwww.supplier.com">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <!-- <input type="status" id="status"  name="status" value="{{ @$supplier_data[0]['status'] }}" required class="form-control" placeholder="Status"> -->
                                <select id="status"  name="status" class="form-control" placeholder="Status">
                               
                                    <option value="100"> ACTIVE </option>
                                    <option value="1"> DE-ACTIVE </option>
                               
                                </select>
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="upload" class="col-sm-2 control-label">Supplier Logo</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" name="uploadlogo" class="custom-file-input" id="uploadlogo" accept="image/*">
                                    <label class="custom-file-label" for="uploadlogo">Choose file</label>
                                </div>                            
                            </div>
                        </div>
 
                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">  

                        <input type="text" id="id" name="id" value="{{ @$user_data['id'] }}" class="form-control" placeholder="id" />
                                              
                        <button type="reset" class="btn btn-default float-right"> Cancel</button> &nbsp;&nbsp; 
                        <button type="submit" class="btn btn-info float-right"> Submit </button>
                    </div>
                    <!-- /.card-footer -->
                </form>
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

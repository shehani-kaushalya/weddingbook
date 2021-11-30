@section('custom_css')


@stop
@extends('layouts.admin_app')
@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Staff</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Staff</li>
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
            <h3 class="card-title">Customer >> {{ @$customers_data['page'] }}</h3>
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

                    <form name="user_data" id="user_data" method="post" action="{{ route('customers.address_store') }}"  enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">



                            <div class="form-group row">
                                <label for="custName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                <input type="text" value="{{ @$address_data[0]['name'] }}" name="custName" class="form-control" id="custName" placeholder="Full Name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="streetAddress" class="col-sm-2 col-form-label">Street Address</label>
                                <div class="col-sm-10">
                                <input type="text" value="{{ @$address_data[0]['street_address'] }}" name="streetAddress" class="form-control" id="streetAddress" placeholder="Street Address" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="streetAddress2" class="col-sm-2 col-form-label">Street Address2</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ @$address_data[0]['street_address2'] }}" name="streetAddress1" class="form-control" id="streetAddress1" placeholder="Street Address2" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="streetAddress3" class="col-sm-2 col-form-label">Street Address3</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ @$address_data[0]['street_address3'] }}" name="streetAddress3" class="form-control" id="streetAddress3" placeholder="Street Address3">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ @$address_data[0]['city'] }}" name="city" class="form-control" id="city" placeholder="City" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="state" class="col-sm-2 col-form-label">State</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ @$address_data[0]['state'] }}" name="state" class="form-control" id="state" placeholder="State">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="zipcode" class="col-sm-2 col-form-label">Zip Code</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ @$address_data[0]['zip_code'] }}" name="zipcode" class="form-control" id="zipcode" placeholder="Zip Code">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="postcode" class="col-sm-2 col-form-label">Post Code</label>
                                <div class="col-sm-10">
                                    <input type="text" name="postal_code" value="{{ @$address_data[0]['postal_code'] }}" class="form-control" id="postal_code" placeholder="Post Code" required>
                                </div>
                            </div>



                        </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" id="id" name="id" value="{{ @$customers_data['id'] }}" class="form-control" placeholder="customer id" />
                            <input type="hidden" id="add_id" name="add_id" value="{{ @$address_data[0]['id'] }}" class="form-control" placeholder="address id" />
                            <input type="hidden" id="type" name="type" value="{{ \App\User::CUSTOMER }}" class="form-control" placeholder="type" />

                            <button type="reset" class="btn btn-default float-right"> Cancel </button>
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


@section('custom_js')



@stop




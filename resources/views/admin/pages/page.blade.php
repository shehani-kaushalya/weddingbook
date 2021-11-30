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
                        <li class="breadcrumb-item active">Add Pages</li>
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
                        <h3 class="card-title">Add new page</h3>
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

                        <form action="{{route('pages.page.store')}}" method="post" enctype="multipart/form-data">
                            <div class="row">
                                @csrf
                                <div class="col-md-8">
                                    <div class="page_detail">
                                        <div class="header">
                                            <div class="col-md-12">Page Name </div>
                                            <input type="text" class="form-control" placeholder="Page Name" name="name" value="{{ @$pages_data['name'] }}" required />
                                        </div>

                                        <div class="header" style="margin-top: 10px">
                                            <div class="col-md-12">Slug</div>
                                            <input type="text" class="form-control" placeholder="Slug" name="slug" minlength="3" value="{{ @$pages_data['slug'] }}" required />
                                            </div>
                                        <div class="body" style="margin-top: 10px">
                                            <div class="col-md-12">Page Body </div>
                                            <textarea class="textarea" name="body" cols="30" rows="10" placeholder="Meta Description" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ @$pages_data['body'] }}</textarea>
                                        </div>
                                        <div class="footer" style="margin-top: 20px">
                                            <div class="row" style="margin-bottom: 10px">
                                                <div class="col-md-3">Meta Title </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="meta_title" value="{{ @$pages_data['meta_title'] }}" placeholder="Meta Title" />
                                                </div>
                                            </div>
                                            <div class="row" style="margin-bottom: 10px">
                                                <div class="col-md-3">Meta Description</div>
                                                <div class="col-md-9">
                                                    <textarea type="text" class="form-control" name="meta_description" placeholder="Meta Description">{{ @$pages_data['meta_description'] }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-bottom: 10px">
                                                <div class="col-md-3">Meta Keywords </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="meta_keywords" value="{{ @$pages_data['meta_keywords'] }}" placeholder="Meta Keywords" />
                                                </div>
                                            </div>
                                            <div class="row" style="margin-bottom: 10px">
                                                <div class="col-md-3">Meta Type </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="meta_type" value="{{ @$pages_data['meta_type'] }}" placeholder="Meta Type" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="page_meta">
                                        <div class="card card-secondary">
                                            <div class="card-header">
                                                <h3 class="card-title">Page Status</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool"
                                                        data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                                <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body" style="display: block;">
                                                <select name="status" class="form-control">
                                                    @if(@$pages_data['status'] == 100 )
                                                        <option value="100" selected>Published</option>
                                                        <option value="10">Draft</option>
                                                    @else
                                                        <option value="100">Published</option>
                                                        <option value="10" selected>Draft</option>
                                                    @endif
                                                </select>
                                                <hr>
                                                <input type="submit" class="btn btn-primary pull-right" value="Save">

                                            </div>
                                            <!-- /.card-body -->
                                        </div>


                                        <div class="card card-secondary">
                                            <div class="card-header">
                                                <h3 class="card-title">Category</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool"
                                                        data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                                <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body" style="display: block;">
                                                <select name="category_id" class="form-control main_cat" required>
                                                    <option value="">Please select</option>
                                                    @foreach (@$category_data as $cat)
                                                        @if(@$pages_data['category_id'] == $cat->id )
                                                            <option value="{{@$cat->id}}" selected>{{@$cat->name}}</option>
                                                        @else
                                                            <option value="{{@$cat->id}}">{{@$cat->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>


                                        <div class="card card-secondary">
                                            <div class="card-header">
                                                    Featured Image
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body" style="display: block;">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="text-center">
                                                        @if(@$pages_data['featured_image'] != "")
                                                            <img id="profileImage" name="profileImage" class="profile-user-img img-fluid img-circle"
                                                            src="{{ config('app.asset_url') }}/pages/{{ @$pages_data['featured_image'] }}" style="width:100px; height:100px"
                                                            alt="Profile picture" />
                                                        @else
                                                            <img id="profileImage" name="profileImage" class="profile-user-img img-fluid img-circle"
                                                            src="{{ config('app.asset_url') }}/admin/dist/img/avatar3.png" style="width:100px; height:100px"
                                                            alt="Profile picture" />
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="custom-file">
                                                        <input type="file" name="upload" class="custom-file-input" id="inputFile" onchange="showMyImage(this)" accept="image/*">
                                                        <label class="custom-file-label" for="inputFile">Choose file</label>
                                                    </div>
                                                </div>
                                                <label for="upload" class="col-sm-12 control-label">Upload Image</label>
                                            </div>

                                            <input type="hidden" id="pageId" name="pageId" value="{{ @$pages_data['id'] }}" class="form-control" placeholder="id" />
                                            <input type="hidden" id="type" name="type" value="{{ \App\User::ADMIN }}" class="form-control" placeholder="type" />


                                            </div><!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>
                            </div>
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


        <!-- Select2 -->
        <script src="{{ config('app.asset_url') }}/admin/plugins/select2/js/select2.full.min.js"></script>
        <!-- Bootstrap4 Duallistbox -->
        <script src="{{ config('app.asset_url') }}/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
        <!-- InputMask -->
        <script src="{{ config('app.asset_url') }}/admin/plugins/moment/moment.min.js"></script>
        <script src="{{ config('app.asset_url') }}/admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

        <!-- jQuery -->
        <script src="{{ config('app.asset_url') }}/admin/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ config('app.asset_url') }}/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ config('app.asset_url') }}/admin/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ config('app.asset_url') }}/admin/dist/js/demo.js"></script>
        <!-- Summernote -->
        <script src="{{ config('app.asset_url') }}/admin/plugins/summernote/summernote-bs4.min.js"></script>

        <script>
        $(function () {
            // Summernote
            $('.textarea').summernote()
        })
        </script>

        <!-- Page script -->
        <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
            theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('yyyy/mm/mm', { 'placeholder': 'yyyy/mm/dd' })
            //Money Euro
            $('[data-mask]').inputmask()

        })

            function showMyImage(fileInput) {
                var files = fileInput.files;
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var imageType = /image.*/;
                    if (!file.type.match(imageType)) {
                        continue;
                    }
                    var img=document.getElementById("profileImage");
                    img.file = file;
                    var reader = new FileReader();
                    reader.onload = (function(aImg) {
                        return function(e) {
                            aImg.src = e.target.result;
                        };
                    })(img);
                    reader.readAsDataURL(file);
                }
            }

        </script>

    @stop

@extends('layouts.admin_app')

@section('custom_css')

 <!-- Font Awesome -->
 <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">  
 <!-- Ionicons -->
 <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

 <!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">  
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">  


@stop

@section('content')

     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Customer Profile</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">User Profile</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
    
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
    
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                        {{-- <img id="uploadlogo" name="uploadlogo" class="profile-user-img img-fluid img-circle"
                        src="{{ config('app.asset_url') }}/admin/dist/img/avatar3.png"
                        alt="User Customer profile" />    --}}
                        
                        @if(!isset($customers_data->image))         
                          <img id="uploadlogo" name="uploadlogo" style="width:150px; height:150px;" src="{{ config('app.asset_url') }}/admin/dist/img/avatar5.png" class="profile-user-img img-fluid img-circle"  alt="User Customer profile" title="User Customer profile">         
                        @else
                          <img id="uploadlogo" name="uploadlogo" style="width:150px; height:150px;" src="{{config('amax.s3_bucket_url')}}/{{ $customers_data->image }}" class="profile-user-img img-fluid img-circle"  alt="User Customer profile" title="User Customer profile">
                        @endif
                    </div>
    
                    <h3 class="profile-username text-center">{{ @$customers_data->first_name }} {{ @$customers_data->last_name }}</h3>
    
                    <p class="text-muted text-center">{{ @$customers_data->email }}</p>  
                    <p class="text-muted text-center">Phone : {{ @$customers_data->phone }}</p>  
                    
                    
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Summary</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Recently Viewed</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Bids/Offers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Purchase History</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Watching</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Saved Searches</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Saved Sellers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Sell Menu</b> <a class="float-right">1,322</a>
                            </li>

                            <?php /*
                            Your Lists
                            Wish List
                            Shopping List
                            Create a List
                            Find a Gift
                            Save Items from the Web
                            Wedding Registry
                            Baby Registry
                            Friends & Family Gifting
                            AmazonSmile Charity Lists
                            Pantry Lists
                            Your Hearts
                            Explore Idea Lists
                            Explore Showroom
                            Take the Home Style Quiz
                            Your Account
                            Your Account
                            Your Orders
                            Your Lists
                            Your Recommendations
                            Your Subscribe & Save Items
                            Memberships & Subscriptions
                            Your Service Requests
                            Your Garage
                            Your Fanshop
                            Your Pets
                            Your Content and Devices
                            Your Music Library
                            Your Amazon Drive
                            Your Prime Video
                            Your Kindle Unlimited
                            Your Watchlist
                            Your Video Library
                            Your Android Apps & Devices
                            Switch Accounts
                            Sign Out
                            */
                            ?>

                        </ul>    
                    <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <?php
                /*
                <!-- About Me Box -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Education</strong>
    
                    <p class="text-muted">
                      B.S. in Computer Science from the University of Tennessee at Knoxville
                    </p>
    
                    <hr>
    
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
    
                    <p class="text-muted">Malibu, California</p>
    
                    <hr>
    
                    <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
    
                    <p class="text-muted">
                      <span class="tag tag-danger">UI Design</span>
                      <span class="tag tag-success">Coding</span>
                      <span class="tag tag-info">Javascript</span>
                      <span class="tag tag-warning">PHP</span>
                      <span class="tag tag-primary">Node.js</span>
                    </p>
    
                    <hr>
    
                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
    
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                */
                ?>
              </div>
              <!-- /.col -->
              <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                      <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                      <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                      <li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Address</a></li>
                    </ul>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{ config('app.asset_url') }}/admin/dist/img/user1-128x128.jpg" alt="user image">
                            <span class="username">
                              <a href="#">Jonathan Burke Jr.</a>
                              <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">Shared publicly - 7:30 PM today</span>
                          </div>
                          <!-- /.user-block -->
                          <p>
                            Lorem ipsum represents a long-held tradition for designers,
                            typographers and the like. Some people hate it and argue for
                            its demise, but others ignore the hate as they create awesome
                            tools to help create filler text for everyone from bacon lovers
                            to Charlie Sheen fans.
                          </p>
    
                          <p>
                            <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                            <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                            <span class="float-right">
                              <a href="#" class="link-black text-sm">
                                <i class="far fa-comments mr-1"></i> Comments (5)
                              </a>
                            </span>
                          </p>
    
                          <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                        </div>
                        <!-- /.post -->
    
                        <!-- Post -->
                        <div class="post clearfix">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{ config('app.asset_url') }}/admin/dist/img/user6-128x128.jpg" alt="User Image">
                            <span class="username">
                              <a href="#">Sarah Ross</a>
                              <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">Sent you a message - 3 days ago</span>
                          </div>
                          <!-- /.user-block -->
                          <p>
                            Lorem ipsum represents a long-held tradition for designers,
                            typographers and the like. Some people hate it and argue for
                            its demise, but others ignore the hate as they create awesome
                            tools to help create filler text for everyone from bacon lovers
                            to Charlie Sheen fans.                            
                          </p>
    
                          <form class="form-horizontal">
                            <div class="input-group input-group-sm mb-0">
                              <input class="form-control form-control-sm" placeholder="Response">
                              <div class="input-group-append">
                                <button type="submit" class="btn btn-danger">Send</button>
                              </div>
                            </div>
                          </form>
                        </div>
                        <!-- /.post -->
    
                        
                        <!-- Post -->
                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{ config('app.asset_url') }}/admin/dist/img/avatar3.png" alt="User Image">
                            <span class="username">
                              <a href="#">Adam Jones</a>
                              <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">Posted 5 photos - 5 days ago</span>
                          </div>
                          <!-- /.user-block -->
                          <div class="row mb-3">
                            <div class="col-sm-6">
                              <img class="img-fluid" src="{{ config('app.asset_url') }}/admin/dist/img/photo1.png" alt="Photo" /> 
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                              
                              
                              <div class="row">
                                <div class="col-sm-6">
                                  <img class="img-fluid mb-3" src="{{ config('app.asset_url') }}/admin/dist/img/photo2.png" alt="Photo">
                                  <img class="img-fluid mb-3" src="{{ config('app.asset_url') }}/admin/dist/img/photo3.jpg" alt="Photo">
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                  <img class="img-fluid mb-3" src="{{ config('app.asset_url') }}/admin/dist/img/photo4.jpg" alt="Photo">
                                  <img class="img-fluid mb-3" src="{{ config('app.asset_url') }}/admin/dist/img/photo1.png" alt="Photo">
                                </div>
                                <!-- /.col -->
                              </div>
                             
                              <!-- /.row -->
                            </div>
                            <!-- /.col -->
                    

                          </div>
                          <!-- /.row -->
    
                          <p>
                            <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                            <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                            <span class="float-right">
                              <a href="#" class="link-black text-sm">
                                <i class="far fa-comments mr-1"></i> Comments (5)
                              </a>
                            </span>
                          </p>    
                          <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                        </div>
                        <!-- /.post -->


                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <div class="timeline timeline-inverse">
                          <!-- timeline time label -->
                          <div class="time-label">
                            <span class="bg-danger">
                              10 Feb. 2014
                            </span>
                          </div>
                          <!-- /.timeline-label -->
                          <!-- timeline item -->
                          <div>
                            <i class="fas fa-envelope bg-primary"></i>
    
                            <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 12:05</span>
    
                              <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
    
                              <div class="timeline-body">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                quora plaxo ideeli hulu weebly balihoo...
                              </div>
                              <div class="timeline-footer">
                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                              </div>
                            </div>
                          </div>
                          <!-- END timeline item -->
                          <!-- timeline item -->
                          <div>
                            <i class="fas fa-user bg-info"></i>
    
                            <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>
    
                              <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                              </h3>
                            </div>
                          </div>
                          <!-- END timeline item -->
                          <!-- timeline item -->
                          <div>
                            <i class="fas fa-comments bg-warning"></i>
    
                            <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>
    
                              <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
    
                              <div class="timeline-body">
                                Take me to your leader!
                                Switzerland is small and neutral!
                                We are more like Germany, ambitious and misunderstood!
                              </div>
                              <div class="timeline-footer">
                                <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                              </div>
                            </div>
                          </div>
                          <!-- END timeline item -->
                          <!-- timeline time label -->
                          <div class="time-label">
                            <span class="bg-success">
                              3 Jan. 2014
                            </span>
                          </div>
                          <!-- /.timeline-label -->
                          <!-- timeline item -->
                          <div>
                            <i class="fas fa-camera bg-purple"></i>
    
                            <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 2 days ago</span>
    
                              <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
    
                              <div class="timeline-body">
                                <img src="http://placehold.it/150x100" alt="...">
                                <img src="http://placehold.it/150x100" alt="...">
                                <img src="http://placehold.it/150x100" alt="...">
                                <img src="http://placehold.it/150x100" alt="...">
                              </div>
                            </div>
                          </div>
                          <!-- END timeline item -->
                          <div>
                            <i class="far fa-clock bg-gray"></i>
                          </div>
                        </div>
                      </div>
                      <!-- /.tab-pane -->
    
                      <div class="tab-pane" id="settings">
                        <form class="form-horizontal">
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="inputName" placeholder="Name">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputName2" placeholder="Name">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.tab-pane -->




                      <div class="tab-pane" id="address">

                          {{-- <div class="timeline-footer">
                              <a href="{{ route('customers.address') }}/{{ @$customers_data->id }} " class="btn btn-primary btn-sm">Add New Address</a>
                          </div> --}}    
                          
                          
                          <?php
                          // exit;
                          ?>

                        @if(isset($customers_data->address) && count($customers_data->address) > 0 )
                            
                          @foreach($customers_data->address as $address)
                            <div class="tab-pane">
                              <!-- The timeline -->
                              <div class="timeline-item"> <hr/> </div>
                              <div class="timeline-item">                                
                              <h3 class="timeline-header"><a href="#">{{ @$address->name }}</a> {{ ($address->is_primary == 0) ? '' : '[Primary Address]' }}</h3>
                                  <div class="timeline-body">
                                      <span>{{ $address->street_address }}</span><br/>
                                      <span>{{ $address->street_address2 }}</span><br/>
                                      <span>{{ $address->street_address3 }}</span><br/>
                                      <span>{{ $address->city }}</span><br/>
                                      <span>{{ $address->state }}</span><br/>
                                      <span>{{ $address->postal_code }}</span><br/>
                                      <span>{{ $address->zip_code }}</span><br/>
                                      
 	 	 	 	 	 	 	                        {{-- status 	is_primary 	remember_token 	created_at 	updated_at  --}}
                                  </div>
                                  <div class="timeline-footer">
                                      <a href="address_edit/{{ @$address->id }}" class="btn btn-secondary btn-sm">Edit</a>
                                      @if ($address->is_primary == 0)
                                        {{-- <a href="{{ route('customers.address') }}/{{ @$customers_data->id }} " class="btn bg-gradient-success btn-sm">Make Primary</a> --}}
                                        <button type="button" class="btn bg-gradient-success btn-sm make-primary" data-toggle="modal" data-target="#modal-lg" onClick="assignURL({{ @$address->id }});">
                                            Make Primary
                                        </button>
                                        @else
                                        {{-- <a href="{{ route('customers.address') }}/{{ @$customers_data->id }} " class="btn bg-gradient-success btn-sm">Make Primary</a> --}}
                                      @endif
                                      <a href="address_delete/{{ @$customers_data->id }}" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                          @endforeach

                        @else
                          No Address Associate with this account
                        @endif
                        <br/>
                            

                        <div class="timeline-footer">
                            {{-- <a href="{{ route('customers.address_new') }}/1" class="btn btn-primary btn-sm">Add New Address</a> --}}
                            <a href="address_new/{{ @$customers_data->id }}" class="btn btn-primary btn-sm">Add New Address</a>

                        </div>
                        
                      </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
    

      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Customer Management</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to set this address as primary?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
              {{-- <button type="button"  class="btn btn-primary">Save changes</button> --}}
              <a href="" id="cmPrimary" class="btn bg-gradient-success btn-sm">Confirm Make Primary</a>
                                        
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
@stop



@section('custom_js')

<script>

  function assignURL(param){
    // alert("Bingo" + param);
    // var oldUrl = $(this).attr("href"); // Get current url.
    // $(this).attr("href", newUrl); // Set herf value.
    //cmPrimary
    //var aUrl = '<?php echo(config('app.asset_url')); ?>';
    //alert(aUrl);
    $("#cmPrimary").attr("href", "makeprimary/"+param);

  }

</script>

<?php 
/*
<!-- Select2 -->
<script src="{{ config('app.asset_url') }}/admin/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ config('app.asset_url') }}/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="{{ config('app.asset_url') }}/admin/plugins/moment/moment.min.js"></script>
<script src="{{ config('app.asset_url') }}/admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
 */ 
?>
  <!-- jQuery -->
  <script src="{{ config('app.asset_url') }}/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ config('app.asset_url') }}/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="{{ config('app.asset_url') }}/admin/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="{{ config('app.asset_url') }}/admin/plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{ config('app.asset_url') }}/admin/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ config('app.asset_url') }}/admin/dist/js/demo.js"></script>

@stop


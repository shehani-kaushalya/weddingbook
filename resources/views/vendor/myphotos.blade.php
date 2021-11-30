@extends('layouts.frontend_app')
@section('custom_css')
<style>
* {
    box-sizing: border-box;
}

/* Slideshow container for */
.slideshow-container {
    max-width: 1000px;
    position: relative;
    margin: auto;
}

/* Hide the images by default */
.mySlides {
    display: none;
}

/* Next & previous buttons */
.prev,
.next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    margin-top: -22px;
    padding: 16px;
    color: white;
    font-weight: bold;
    font-size: 18px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
}

/* Position the "next button" to the right */
.next {
    right: 0;
    border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

/* Caption text */
.text {
    color: #f2f2f2;
    font-size: 15px;
    padding: 8px 12px;
    position: absolute;
    bottom: 8px;
    width: 100%;
    text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
}

/* The dots/bullets/indicators */
.dot {
    cursor: pointer;
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    transition: background-color 0.6s ease;
}

.active,
.dot:hover {
    background-color: #717171;
}

/* Fading animation */
.fade {
    -webkit-animation-name: fade;
    -webkit-animation-duration: 1.5s;
    animation-name: fade;
    animation-duration: 1.5s;
}

@-webkit-keyframes fade {
    from {
        opacity: .4
    }

    to {
        opacity: 1
    }
}

@keyframes fade {
    from {
        opacity: .4
    }

    to {
        opacity: 1
    }
}
</style>
@stop


@section('content')

<body class="page">



    <main class="page__wrapper">
        <div class="page__wrapper-column">
            @include('frontend.vendor_nav')
        </div>

        <form method="POST" name="business_profile" id="business_profile" action="{{ route('myphotobook') }}"
            enctype="multipart/form-data">

            @csrf
            <div class="page__wrapper-column">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="text-center">
                                    @if(@$vender_data->biz_logo != "")
                                        <img id="profileImage" name="profileImage"
                                            class="profile-user-img img-fluid img-circle"
                                            src="{{ config('app.asset_url') }}/vender/{{ @$vender_data->biz_logo }}"
                                            style="width:100px; height:100px" alt="Profile picture" />
                                    @else
                                        <img id="profileImage" name="profileImage"
                                            class="profile-user-img img-fluid img-circle"
                                            src="{{ config('app.asset_url') }}/admin/dist/img/avatar3.png"
                                            style="width:100px; height:100px" alt="Profile picture" />

                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="custom-file">
                                    <input type="file" name="upload" class="custom-file-input" id="inputFile"
                                        onchange="showMyImage(this)" />
                                    <label class="custom-file-label" for="inputFile">Choose file</label>
                                </div>
                            </div>
                            <label for="upload" class="col-sm-12 control-label">Upload Image</label>
                        </div>

                        <div class="form-group row">
                                <button class="link-button link-button--submit">Save</button> &nbsp; <button class="link-button link-button--submit">Cancel</button>
                                <input type="hidden" id="venderId" name="venderId" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" class="form-control" placeholder="id" />
                        </div>

                    </div>


                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" required value="{{ @$vender_image_data['title'] }}" id="title" class="form-control" placeholder="Title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea type="text" name="description" value="" id="description" class="form-control" placeholder="Description">{{ @$vender_image_data['description'] }}</textarea>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    @if(count($vender_data['photos']) > 0)
                        @foreach($vender_data['photos'] as $key => $photos)


                            <div class="col-sm-3">
                                <img id="profileImage" name="profileImage"
                                class="profile-user-img img-fluid"
                                src="{{ config('app.asset_url') }}/vender/{{ @$photos->image }}"
                                style="width:200px; height:200px"
                                alt="{{ @$photos->title }}"
                                title="{{ @$photos->title }}"  />
                            </div>
                        @endforeach
                    @endif
                </div>



            </div>
        </form>
    </main>



    @stop


    @section('custom_js')
    <script language="JavaScript">
    function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var imageType = /image.*/;
            if (!file.type.match(imageType)) {
                continue;
            }
            var img = document.getElementById("profileImage");
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





    //API-KEY : AIzaSyBaCI0EG_5EtDfr00Rdz4ceLYsaUjyoDlE
    </script>
    @stop

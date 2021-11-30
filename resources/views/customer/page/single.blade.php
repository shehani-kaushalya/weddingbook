@extends('layouts.customer_app')
@section('custom_css')
    <style>

    </style>
@endsection
@section('contents')
    <main class="main">

        <div class="page-header page-header-bg" style="background-image: url('{{config('amax.s3_bucket_url')}}/{{$page->featured_image}}');">
            <div class="container">
                <h1 style="color: #fff">
                    {{$page->name}}</h1>
                {{--<a href="" class="btn btn-dark">Contact</a>--}}
            </div><!-- End .container -->
        </div>


        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.home')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$page->name}}</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="about-section">
            <div class="container">


                {!! $page->body !!}


        </div>




    </main><!-- End .main -->
@endsection

@section('custom_js')

@endsection


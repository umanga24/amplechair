@extends('layouts.front')
@section('page_title')
@endsection
@section('meta')
{{--
<meta name="description" content="{{@$page_info->meta_description}}"/>

<meta property="og:locale" content="en_GB" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{@$page_info->meta_title}}" />
<meta property="og:description" content="{{@$page_info->meta_description}}" />
<meta property="og:url" content="{{route('homepage')}}" />
<meta property="og:site_name" content="{{route('homepage')}}" />
<meta property="og:image" content="{{asset('/uploads/page/'.@$page_info->thumbnail)}}">

<meta name="twitter:card" content="{{@$page_info->meta_title}}" />
<meta name="twitter:description" content="{{@$page_info->meta_description}}" />
<meta name="twitter:title" content="{{@$page_info->meta_title}}" />
<meta name="twitter:creator" content="{{@$page_info->writer}}" />
<meta name="twitter:site" content="{{route('homepage')}}" />
<meta name="twitter:image" content="{{asset('/uploads/page/'.@$page_info->thumbnail)}}">

<meta name="keywords" content="{{@$page_info->meta_keyword}}">
<meta name="keyphrase" content="{{@$page_info->meta_keyphrase}}" />

<meta name="allow-search" content="yes" />
<meta name="auther" content="{{@$page_info->writer}}" />
<meta name="visit-after" content="30 days" />
<meta name="copyright" content="{{date('Y')}} DLY" />
<meta name="coverage" content="Worldwide" />

<meta name="identifier" content="{{route('homepage')}}" />
<meta name="language" content="en" />
<link rel="canonical" href="{{route('homepage')}}" />

<meta name="Robots" content="noodp, noydir, page_info, follow, archive" />
<meta name="Googlebot" content="page_info, follow" />
<link rel="next" href="{{route('homepage')}}">
--}}
@endsection
@section('styles')

<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/inner.css')}}">

@endsection
@section('content')
<div class="breadcrumbs overlay" data-stellar-background-ratio="0.7" style="background-image: url('{{$satya_story->satya_banner}}');">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!--<ul class="list">-->
                <!--    <li><a href="{{route('homepage')}}">Home</a></li>-->
                <!--    <li><a href="#">Satya Story</a></li>-->
                <!--</ul>-->
                <h2>About Us</h2>
            </div>
        </div>
    </div>
</div>

<div class="inner-page-body">
    <!-- First Section: Image Left, Text Right -->
    <div class="row section-padding align-items-center">
        <div class="col-md-6 text-center wow animate__fadeIn" data-duration="2s">
            <div class="about-section-image">
                <img src="{{ asset('/'.$satya_story->path.$satya_story->image) }}" height="500" alt="Image 1">
            </div>
        </div>
        <div class="col-md-6">
            <div class="sub-title text-container">
                <p>{!! $satya_story->satya_description !!}</p>
            </div>
        </div>
    </div>

    <!-- Second Section: Text Left, Image Right -->
    <div class="row section-padding align-items-center flex-row-reverse">
        <div class="col-md-6 text-center wow animate__fadeIn" data-duration="2s">
            <div class="about-section-image">
                <img src="{{ asset('/'.$satya_story->path.$satya_story->image1) }}" height="500" alt="Image 2">
            </div>
        </div>
        <div class="col-md-6">
            <div class="sub-title text-container">
                <p>{!! $satya_story->desc1 !!}</p>
            </div>
        </div>
    </div>

    <!-- Third Section: Image Left, Text Right -->
    <div class="row section-padding align-items-center">
        <div class="col-md-6 text-center wow animate__fadeIn" data-duration="2s">
            <div class="about-section-image">
                <img src="{{ asset('/'.$satya_story->path.$satya_story->image2) }}" height="500" alt="Image 3">
            </div>
        </div>
        <div class="col-md-6">
            <div class="sub-title text-container">
                <p>{!! $satya_story->desc2 !!}</p>
            </div>
        </div>
    </div>

    <!-- Fourth Section: Text Left, Image Right -->
    <div class="row section-padding align-items-center flex-row-reverse">
        <div class="col-md-6 text-center wow animate__fadeIn" data-duration="2s">
            <div class="about-section-image">
                <img src="{{ asset('/'.$satya_story->path.$satya_story->image3) }}" height="500" alt="Image 4">
            </div>
        </div>
        <div class="col-md-6">
            <div class="sub-title text-container">
                <p>{!! $satya_story->desc3 !!}</p>
            </div>
        </div>
    </div>
</div>







@endsection
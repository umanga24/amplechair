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
    <meta name="twitter:creator" content="{{@$page_info->writer}}"/>
    <meta name="twitter:site" content="{{route('homepage')}}"/>
    <meta name="twitter:image" content="{{asset('/uploads/page/'.@$page_info->thumbnail)}}">

    <meta name="keywords" content="{{@$page_info->meta_keyword}}">
    <meta name="keyphrase" content="{{@$page_info->meta_keyphrase}}"/>

    <meta name="allow-search" content="yes"/>
    <meta name="auther" content="{{@$page_info->writer}}"/>
    <meta name="visit-after" content="30 days"/>
    <meta name="copyright" content="{{date('Y')}} DLY"/>
    <meta name="coverage" content="Worldwide"/>

    <meta name="identifier" content="{{route('homepage')}}"/>
    <meta name="language" content="en"/>
    <link rel="canonical" href="{{route('homepage')}}" />

    <meta name="Robots" content="noodp, noydir, page_info, follow, archive"/>
    <meta name="Googlebot" content="page_info, follow"/>
    <link rel="next" href="{{route('homepage')}}">
    --}}
@endsection
@section('styles')

<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/inner.css')}}">

@endsection
@section('content')
<!--<div class="breadcrumbs overlay" data-stellar-background-ratio="0.7" style="background-image: url('https://images.unsplash.com/photo-1509358271058-acd22cc93898?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">-->
     @foreach ($banners as $banner)
<div class="breadcrumbs overlay" data-stellar-background-ratio="0.7"
style="background-image: url({{asset($banner->media_banner) }});">
@endforeach   
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!--<ul class="list">-->
                <!--    <li><a href="{{route('homepage')}}">Home</a></li>-->
                <!--    <li><a href="#">Media</a></li>-->
                <!--</ul>-->
                <h2>Media</h2>
            </div>
        </div>
    </div>
</div>

<div class="inner-page-body">

    <div class=" section-padding">
        <div class="container">
                        <div class="row sigma_broadcast-video video-inner">
                <div class="col-12">
                               <div class="row">
                                @foreach ($videos as $video)


                                <div class="col-md-4">
                                    <div class="thumbnail position-relative">
                                        <a data-fancybox="video-gallery" href="{{$video->link}}">
                                            <img class="media-img" src="{{$video->media_image}}">
                                            <div class="play-btn">
                                                <i class="fa fa-play-circle" aria-hidden="true"></i>

                                            </div>
                                            </a>

                                    </div>
                                </div>
                                @endforeach

            </div>

                </div>
            </div>

        </div>
    </div>

</div>



@endsection

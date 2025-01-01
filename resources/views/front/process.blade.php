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
@foreach ($banners as $banner)
<div class="breadcrumbs overlay" data-stellar-background-ratio="0.7"
    style="background-image: url({{ asset($banner->process_banner) }});">
    @endforeach


    <div class="container">
        <div class="row">
            <div class="col-12">
                <!--<ul class="list">-->
                <!--    <li><a href="{{route('homepage')}}">Home</a></li>-->
                <!--    <li><a href="#">Processing</a></li>-->
                <!--</ul>-->
                <h2>Processing</h2>
            </div>
        </div>
    </div>
</div>

<div class="inner-page-body">

    <div class=" section-padding">
        <div class="container">
            <div class="sub-title text-container w-100">
                <h3 class="mb-3">About Us</h3>
                @if (isset($operations[0]) && $operations[0] != null)
                <p>{!! $operations[0]->process_description !!}</p>
                @else
                <p>No Content</p>
                @endif
            </div>
            <div class="sus mt-5 pt-5">
                <div class="row align-items-center mb-5">
                    @foreach ($operations as $operation)


                    <div class="col-md-6">
                        <div class="cert-wrapper">
                            <div class="img-container">
                                <img class="w-100" src="{{$operation->process_image}}">
                            </div>
                            <div class="cert-detail">
                                <!-- <h4>{{ $operation->process_title}}</h4> -->
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>

</div>
@endsection
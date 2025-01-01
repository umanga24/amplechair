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
@foreach ($banners as $banner)
<div class="breadcrumbs overlay" data-stellar-background-ratio="0.7"
style="background-image: url({{ asset($banner->team_banner) }});">
@endforeach
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!--<ul class="list">-->
                <!--    <li><a href="{{route('homepage')}}">Home</a></li>-->
                <!--    <li><a href="#">Team</a></li>-->
                <!--</ul>-->
                <h2>Our Team</h2>
            </div>
        </div>
    </div>
</div>

<div class="inner-page-body">

    <div class=" section-padding">
        <div class="container">
            <div class="row">
          @foreach ($teams as $team)


                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="team-wrapper">
                       <img src="{{asset($team->photo)}}" alt="">
                       <div class="team-detail">
                           <h3>{{$team->name}}</h3>
                           <p class="mb-0">{{$team->designation}}</p>
                       </div>
                    </div>
                </div>

                @endforeach


            </div>
        </div>
    </div>

</div>
@endsection

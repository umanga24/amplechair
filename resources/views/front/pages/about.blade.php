@extends('layouts.front')
@section('page_title') {{@$page_info->title}}  @endsection
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
<div class="breadcrumbs overlay" data-stellar-background-ratio="0.7" style="background-image: url('{{asset('/uploads/page/'.$page_info->thumbnail)}}');">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list">
                    <li><a href="{{route('homepage')}}">Home</a></li>
                    <li><a href="#">{{@$page_info->title}}</a></li>
                </ul>
                <h2>{{@$page_info->title}}</h2>
            </div>
        </div>
    </div>
</div>

<div class="inner-page-body">

    <div class="inner-section-area-1 section-1 section-padding">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-about-img">
                       
                        {!! html_entity_decode(@$page_info->description) !!}
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div>
@endsection
 
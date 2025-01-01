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
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/front/css/inner.css') }}">
@endsection
@section('content')

   
@foreach ($banners as $banner)
 <div class="breadcrumbs overlay" data-stellar-background-ratio="0.7"
 style="background-image: url({{ asset($banner->sustain_banner) }});">
@endforeach
        
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!--<ul class="list">-->
                    <!--    <li><a href="{{ route('homepage') }}">Home</a></li>-->
                    <!--    <li><a href="#">Sustainibility</a></li>-->
                    <!--</ul>-->
                    <h2>Sustainibility</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="inner-page-body">

        <div class=" section-padding">
            <div class="container">
                <div class="sub-title text-container w-100">
                    <h3 class="mb-3">Sustainability</h3>

                    @if (isset($sustains[0]) && $sustains[0] != null)
                        <p>{{ $sustains[0]->short_description }}</p>
                    @else
                        <p>No Content</p>
                    @endif


                    {{-- @if (!empty($sustains) && $sustains[0] != null)
                <p>{{ $sustains[0]->short_description }}</p>
            @else
                <p>No title</p>
            @endif --}}


                    {{-- @if ($sustains[0]->short_description->null){
                        <h1>This is null</h1>

                    } --}}










                    </p>
                </div>
                <div class="sus mt-5 pt-5">
                    @foreach ($sustains as $sustain)
                        <div class="row align-items-center mb-5">
                            <div class="col-md-4">
                                <div class="img-container">
                                    <img class="w-100" src="{{ asset($sustain->image1) }}">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="text-container">
                                    <p>{!! $sustain->description !!} </p>

                                </div>
                            </div>
                        </div>
                    @endforeach


                    {{-- <div class="row align-items-center mb-5">
                <div class="col-md-4">
                    <div class="img-container">
                        <img class="w-100" src="{{asset('assets/front/images/sus2.png')}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="text-container">
                        <p>True development of a nation happens when both men and women of the country are given equal opportunities to grow and make their lives better. With this philosophy, we at Satya are committed to empowering women in our workforce. From being a part of our farmer community to being the spine of our company’s operation, women continue to lead the way.  </p>

                    </div>
                </div>
            </div>


            <div class="row align-items-center mb-5">
                <div class="col-md-4">
                    <div class="img-container">
                        <img class="w-100" src="{{asset('assets/front/images/sus3.png')}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="text-container">
                        <p>Currently Nepal’s unemployment rate is around 1.47%. At Satya, we are committed to achieve full and productive employment, and decent work. Hence, we majorly focus on employing local population. We constantly work towards providing our employees a safe environment where they grow and thrive. We try and build a culture of collaboration, trust and respect.  </p>

                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-5">
                <div class="col-md-4">
                    <div class="img-container">
                        <img class="w-100" src="{{asset('assets/front/images/sus4.png')}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="text-container">
                        <p>One of our core focus areas is to ensure the sustainability of the environment. While working with natural resources, we ensure that in the process of collection, processing and extraction of our products, the impact on the ecosystem is minimal. We continually train our partner farmers and collectors for sustainable practices in their work as well.  </p>

                    </div>
                </div>
            </div> --}}


                </div>
            </div>
        </div>

    </div>
@endsection

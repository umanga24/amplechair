@extends('layouts.front')
@section('page_title') {{$post_detail->title}}@endsection
@section('meta')
<meta name="description" content="{{@$post_detail->meta_description}}"/>
    
    <meta property="og:locale" content="en_GB" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{@$post_detail->meta_title}}" />
    <meta property="og:description" content="{{@$post_detail->meta_description}}" />
    <meta property="og:url" content="{{route('homepage')}}" /> 
    <meta property="og:site_name" content="{{route('homepage')}}" />
    <meta property="og:image" content="{{asset('/uploads/page/'.@$post_detail->thumbnail)}}">

    <meta name="twitter:card" content="{{@$post_detail->meta_title}}" />
    <meta name="twitter:description" content="{{@$post_detail->meta_description}}" />
    <meta name="twitter:title" content="{{@$post_detail->meta_title}}" />
    <meta name="twitter:creator" content="{{@$post_detail->writer}}"/>
    <meta name="twitter:site" content="{{route('homepage')}}"/>
    <meta name="twitter:image" content="{{asset('/uploads/page/'.@$post_detail->thumbnail)}}"> 

    <meta name="keywords" content="{{@$post_detail->meta_keyword}}">
    <meta name="keyphrase" content="{{@$post_detail->meta_keyphrase}}"/>
    
    <meta name="allow-search" content="yes"/>
    <meta name="auther" content="{{@$post_detail->writer}}"/>
    <meta name="visit-after" content="30 days"/>
    <meta name="copyright" content="{{date('Y')}} DLY"/>
    <meta name="coverage" content="Worldwide"/>

    <meta name="identifier" content="{{route('homepage')}}"/>
    <meta name="language" content="en"/>
    <link rel="canonical" href="{{route('homepage')}}" />

    <meta name="Robots" content="noodp, noydir, post_detail, follow, archive"/>
    <meta name="Googlebot" content="post_detail, follow"/>
    <link rel="next" href="{{route('homepage')}}">
@endsection
@section('styles')
 
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/inner.css')}}">

@endsection
@section('content')
<section class="blog-detail-page mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12">
                <div class="blog-detai-side">
                    <figure style="background-image:url('{{asset('/uploads/blog/'.$post_detail->thumbnail)}}')"></figure>
                    <div class="blog-detail-content">
                        <h2>{{@$post_detail->title}}</h2>
                        <p>
                            {!! html_entity_decode(@$post_detail->description) !!}
                        </p>
                       
                             
                    </div>
                </div>
                <!-- <div class="related-blog-wrapp">
                    <h2>Related Blogs</h2>
                    <div class="row">
                        @if(isset($more_blog) && $more_blog->count())
                        @foreach($more_blog as $other_blog)
                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="blog-wrapper blog-detail-image">
                                <a href="{{route('PostDetail', $other_blog->slug)}}">
                                    <figure style="background-image:url('{{asset('/uploads/blog/thumbnail/'.$other_blog->thumbnail)}}')"></figure>
                                </a>
                                <div class="blog-content">
                                    <a href="{{route('PostDetail', $other_blog->slug)}}">
                                        <h3>{{@$other_blog->title}}</h3>
                                    </a>
                                    <span>{{date('M d   Y', strtotime( $other_blog->published_date))}}</span>
                                    <P>{{@$other_blog->summary}}

                                    </p>
                                    <a class="read-btn" href="{{route('PostDetail', $other_blog->slug)}}">Read More</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        
                    </div>
                </div> -->
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                @if(isset($more_blog) && ($more_blog->count()))
                <div class="blog-sidebar">
                    <div class="catalog-wrapp">
                        <h2>Latest Blogs</h2>
                        <ul>
                            @foreach($more_blog as $blog_data)
                            <li><a href="{{route('PostDetail', $blog_data->slug)}}">{{@$blog_data->title}}</a></li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
 
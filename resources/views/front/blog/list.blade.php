@extends('layouts.front')
@section('page_title')
@section('meta')
@include('front.include.meta')
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/inner.css')}}">
@endsection
<!--     @foreach ($banners as $banner)-->
<!--<div class="breadcrumbs overlay" data-stellar-background-ratio="0.7"-->
<!--style="background-image: url({{ asset($banner->blog_banner) }});">-->
<!--@endforeach-->
@section('content')
<section class="blog-listing mt-5">
  
    <div class="container">
   
        <div class="row">
            <div class="col-12">
                <div class="blog-title-wrapper">
                    <h2>Our Latest Blogs</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @if(isset($all_post) &&  $all_post->count())
            @foreach($all_post as $post_data)
            <div class="col-lg-4 col-md-6 col-12 mx-auto">
                <div class="card border-0 blog-list-card">
                    <a class="blog-detail-link-wrapper" href="{{route('PostDetail', $post_data->slug)}}">
                        
                        <img src="{{asset('/uploads/blog/banner/'.$post_data->thumbnail)}}" class="card-img">
                    </a>
                    <div class="card-body">
                        <a href="{{route('PostDetail', $post_data->slug)}}">
                            <h3>{{$post_data->title}}</h3>
                        </a>
                        <!--<span>{{date('M d   Y', strtotime( $post_data->published_date))}}</span>-->
                        <P>
                        {{$post_data->summary}}
                        </p>
                        <a class="btn-blog" href="{{route('PostDetail', $post_data->slug)}}">Read More</a>
                    </div>
                </div>
                <!-- <div class="blog-wrapper">
                    <a class="blog-detail-link-wrapper" href="{{route('PostDetail', $post_data->slug)}}">
                        <img src="{{asset('/uploads/blog/banner/'.$post_data->thumbnail)}}">
                    </a>
                    <div class="blog-content">
                        <a href="{{route('PostDetail', $post_data->slug)}}">
                            <h3>{{$post_data->title}}</h3>
                        </a>
                        <span>{{date('M d   Y', strtotime( $post_data->published_date))}}</span>
                        <P>
                        {{$post_data->summary}}
                        </p>
                        <a class="read-btn" href="{{route('PostDetail', $post_data->slug)}}">Read More</a>
                    </div>
                </div> -->
            </div>
            @endforeach

            @else
            <p>No blog found</p>
            @endif

        </div>
    </div>
</section>
@endsection

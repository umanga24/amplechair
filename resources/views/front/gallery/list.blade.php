@extends('layouts.front')
@section('page_title') {{@$product_info->title}}  @endsection
@section('meta')
@include('front.include.meta')
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
                    <li><a href="/" class="pr-3">Home</a></li>
                    <li><a href="#">{{ @$page_info->title }}</a></li>
                </ul>
                <h2>{{ @$page_info->title }}</h2>
            </div>
        </div>
    </div>
</div>
<section class="gallary_style_two image_hover_effect section-padding p_tb50">
    <div class="container">
        <div class="row">
            @if(isset($gallery_list) && $gallery_list->count())
            @foreach($gallery_list as $gallery_data)
            <div class="col-lg-4 col-md-6 col-12 m_b30">
                <div class="single_image_cover">
                    <div class="single_image">
                        <img src="{{ asset('/uploads/gallery/'.$gallery_data->path.'/'.$gallery_data->thumbnail)}}" class="img-fluid" alt="">
                        <div class="image_overlay">
                            <div class="icon-item-1">
                                <div class="image_icon">
                                    <ul>
                                        <li><a href="{{route('galleryDetail', $gallery_data->slug)}}"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="icon-info-1">
                                <div class="icon-info-text-1">
                                    <h5>{{ @$gallery_data->sub_title }} </h5>
                                    <h6>{{ @$gallery_data->title }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            
            
             
        </div>
    </div>
</section>
@endsection
@section('scripts')
 
@endsection


 
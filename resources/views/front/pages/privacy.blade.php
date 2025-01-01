@extends('layouts.front')
@section('page_title') {{@$page_info->title}}  @endsection
@section('meta')
@include('front.include.meta')
@endsection
@section('styles')
 
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/inner.css')}}">

@endsection
@section('content')

<div class="breadcrumbs overlay" data-stellar-background-ratio="0.7" style="background-image:url('{{asset('/uploads/page/'.$page_info->thumbnail)}}')">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>{{ ucfirst(@$page_info->title ) }}</h2>
                <ul class="list">
                    <li><a href="{{route('homepage')}}" class="pr-3">Home</a></li>
                    <li><a href="#">{{@$page_info->title}}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="about-page">
    <!-- <div class="about-top-image" style="background-image:url('{{asset('/uploads/page/'.$page_info->thumbnail)}}')">
        <div class="container">
            <div class="top-about-content">
                <h2>{{ ucfirst(@$page_info->title ) }}</h2>
            </div>
        </div>
    </div> -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="company-info">
                    {{--
                    <h3>{{ ucfirst(@$page_info->title ) }}</h3>
                    --}}
                    {!! html_entity_decode(@$page_info->summary) !!}
                </div>
            </div>
        </div>
         
        
       
    </div>
</section>
 

 
@endsection
 
@extends('layouts.front')
@section('page_title') {{@$page_info->title}}  @endsection
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
                <!--<ul class="list">-->
                <!--    <li><a href="{{route('homepage')}}">Home</a></li>-->
                <!--    <li><a href="#">{{@$page_info->title}}</a></li>-->
                <!--</ul>-->
                <!-- <h2>{{@$page_info->title}}</h2> -->
            </div>
        </div>
    </div>
</div>

<section class="single-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- <div class="condition-wrapper">
                    <h2>{{@$page_info->title}}</h2>
                    {!! html_entity_decode(@$page_info->summary) !!}
                    {!! html_entity_decode(@$page_info->description) !!}
                    
                </div> -->
            </div>
        </div>
    </div>
</section>
 
 

 
@endsection
 
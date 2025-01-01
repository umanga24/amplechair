@extends('layouts.front')

@section('page_title')   @endsection
@section('meta')
@include('front.include.meta')
@endsection
@section('styles')

<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/inner.css')}}">

@endsection
@section('content')
<div class="breadcrumbs overlay" data-stellar-backgroundratio="0.7" style="background-image: url('https://images.unsplash.com/photo-1514733670139-4d87a1941d55?q=80&w=1778&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' )";>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list">
                    <li><a href="/">Home</a></li>
                    <li><a href="#">Products</a></li>
                </ul>
                <h2>      
            @if(isset($cat_info))
            {{ $title = $cat_info->title }}
            @endif
            @if(isset($child_cat))
            {{$title = $child_cat->title}}
            @endif
            </h2>
            </div>
        </div>
    </div>
</div>

<section class="listing-page">
    <div class="container">
        <h3 class="inner__page__heading__title text-center mb-3">

            @if(isset($cat_info))
            {{ $title = $cat_info->title }}
            @endif
            @if(isset($child_cat))
            {{$title = $child_cat->title}}
            @endif

        </h3>
           <p class="text-center mb-5">{!!htmlspecialchars_decode($cat_info->description)!!}</p>

        <div class="row">
            @foreach($categoryProducts as $product_detail)

            <div class="col-lg-3 col-md-6 col-12">
                <div class="list-wrapper">
                    <img src="{{asset('/uploads/product/'.$product_detail->path.'/main/'.$product_detail->image)}}">
                    <div class="figure-content-wrapp">
                        <h3>{{ $product_detail->title }}</h3>
            
                      
                        
                        <div class="lsting-btn-wrapper">
                            <a class="more-btn list-buy-btn" href="{{route('buyNow', $product_detail->slug)}}">Order Now</a>
                            <a class="view-pro-btn more-btn" href="{{route('ProductDetail', $product_detail->slug)}}">View Product</a>
                        </div> 
                        
                    </div>
                  
                </div>
            </div>

@endforeach 
        </div>
    </div>
</section>
@endsection

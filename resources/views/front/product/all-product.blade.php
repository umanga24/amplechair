@extends('layouts.front')

@section('page_title') @endsection
@section('meta')
@include('front.include.meta')
@endsection
@section('styles')

<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/inner.css')}}">

@endsection
@section('content')

<section class="listing-page">
<div class="col-12">
                <div class="title-wrapper  about-section-title text-center">
                    <h2>Our <span>All Products</span> </h2>
                </div>
            </div>

    <div class="row mt-5">


        <div class="col-lg-12 col-md-12 col-12">
            <div class="row">

                @forelse($products as $product)

                <div class="col-lg-2 col-md-3 col-12">
                    <div class="wall-wrapper">
                        <div class="wall-image">
                            <img src="{{asset('/uploads/product/'.$product->path.'/main/'.$product->image)}}" class="">
                        </div>
                        <div class="wall-content">
                            <h3 class="product-title">{{ $product->title }}</h3>

                            <div class="lsting-btn-wrapper">
                                <!-- <a class="more-btn list-buy-btn" href="{{route('buyNow', $product->slug)}}">Order Now</a> -->
                                <a class="more-btn list-buy-btn" href="{{route('ProductDetail', $product->slug)}}">View Product</a>
                            </div>
                        </div>
                    </div>
                </div>

                @empty
                <div class="alert alert-warning" role="alert">
                    Sorry ! No product available.
                </div>
                @endforelse



            </div>
        </div>
    </div>
    </div>
</section>
@endsection
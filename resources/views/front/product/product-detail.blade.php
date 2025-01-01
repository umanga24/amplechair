@extends('layouts.front')
@section('page_title') {{@$product_info->title}}  @endsection
@section('meta')
@include('front.include.meta')
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/jquery.exzoom.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/inner.css')}}">
@endsection
@section('content')
<section class="product-detail-page mt-5">
    <div class="container">
        <div class="row product-detail-wrapper">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="Wrapper">
                    <div class="single__post">

                        <div class="exzoom hidden" id="exzoom">
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    <li>
                                        <img src="{{asset('/uploads/product/'.$product_info->path.'/main/'.$product_info->image)}}" alt="{{ @$product_info->title }}">
                                    </li>
                                    @if(isset($product_info) && ($product_info) && ($product_info->other_image))
                                    @foreach($product_info->other_image as $key => $images)
                                    <li>
                                        <img src="{{asset('/uploads/product/'.$product_info->path.'/product-images/'.$images->images)}}"  alt="{{ @$product_info->title }}">
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                            <!-- <div class="exzoom_nav"></div>
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="product-info-wrapper">
                   <div class="item-title-wrapp">
                        <h3>{{@$product_info->title}}</h3>

                       <!-- <h3 class="product-rate">$ {{(discount($product_info->price, $product_info->discount))}}</h3>-->
                       <!-- @if($product_info->discount > 0)-->
                       <!--<h4 class="real-price price-wrapp">$ {{number_format($product_info->price, 2)}}</h4>-->
                       <!--@endif-->
                       
                       @if(!empty($product_info->price))
                          <h4 class="price">{{$product_info->price}}</h4>

                       
                       @endif

                        <p>Category:<a href="{{route('getProductByCategories', @$product_info->category_info->slug)}}"> {{ @$product_info->category_info->title}}</a> | <a href="{{route('getProductByCategories', @$product_info->category_info->slug)}}">More Products from {{ @$product_info->category_info->title}}</a></p>
                   </div>

                   <div class="discription-highlight">
                      {!!$product_info->description!!}
                   </div>






                   <div class="single-page-button-wrapper">
                        <!-- <a href="#">Buy Now</a> -->

                         <!-- <a class="btn-blog" href="{{route('buyNow', $product_info->slug)}}">Order Now</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{asset('/assets/front/js/jquery.exzoom.js')}}"></script>
<script>

$(document).ready(function() {
    $('#exzoom').exzoom({
        "navWidth": 60,
        "navHeight": 60,
        "navItemNum": 3,
        "navItemMargin": 10,
        "navBorder": 1,
        "autoPlay": false,
        "autoPlayTimeout": 2000
    })
})
</script>
@endsection



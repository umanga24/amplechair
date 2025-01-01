@extends('layouts.front')
@section('page_title') @endsection
@section('meta')
{{--
<meta name="description" content="{{@$meta_info->meta_description}}"/>

<meta property="og:locale" content="en_GB" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{@$meta_info->meta_title}}" />
<meta property="og:description" content="{{@$meta_info->meta_description}}" />
<meta property="og:url" content="{{route('homepage')}}" />
<meta property="og:site_name" content="{{route('homepage')}}" />
<meta property="og:image" content="{{asset('/uploads/page/'.@$meta_info->thumbnail)}}">

<meta name="twitter:card" content="{{@$meta_info->meta_title}}" />
<meta name="twitter:description" content="{{@$meta_info->meta_description}}" />
<meta name="twitter:title" content="{{@$meta_info->meta_title}}" />
<meta name="twitter:creator" content="{{@$meta_info->writer}}" />
<meta name="twitter:site" content="{{route('homepage')}}" />
<meta name="twitter:image" content="{{asset('/uploads/page/'.@$meta_info->thumbnail)}}">

<meta name="keywords" content="{{@$meta_info->meta_keyword}}">
<meta name="keyphrase" content="{{@$meta_info->meta_keyphrase}}" />

<meta name="allow-search" content="yes" />
<meta name="auther" content="{{@$meta_info->writer}}" />
<meta name="visit-after" content="30 days" />
<meta name="copyright" content="{{date('Y')}} DLY" />
<meta name="coverage" content="Worldwide" />

<meta name="identifier" content="{{route('homepage')}}" />
<meta name="language" content="en" />
<link rel="canonical" href="{{route('homepage')}}" />

<meta name="Robots" content="noodp, noydir, meta_info, follow, archive" />
<meta name="Googlebot" content="meta_info, follow" />
<link rel="next" href="{{route('homepage')}}">
--}}
@endsection
@section('styles')

<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/inner.css')}}">

@endsection
@section('content')
<section class="listing-page">
    <div class="container">
        <h3 class="inner__page__heading__title">



            <!-- @if(count($results['categories']) > 0) 

            <ul>
                @foreach($results['categories'] as $category)
                <li>{{ $category->title }}</li>
                <li>
                    <img src="{{asset('/uploads/category/'.$category->path.'/thumbnail/'.$category->image)}}" height="200">
                </li>

                
                @endforeach
            </ul> 
       @endif  -->


            <div class="col-lg-12 col-md-12 col-12">
                <div class="row"

                    @if(count($relatedProducts)> 0)
                    <h4>Related Products</h4>
                    <div class="row">
                        @foreach($relatedProducts as $product)
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="wall-wrapper">
                                <div class="wall-image">
                                    <img src="{{ asset('/uploads/product/'.$product->path.'/thumbnail/'.$product->image) }}" height="200">
                                </div>
                                <div class="wall-content">
                                    <div class="product-title">
                                        <h3>{{ $product->title }}</h3>
                                    </div>
                                    <div class="lsting-btn-wrapper">
                                        <!-- <a class="more-btn list-buy-btn" href="{{ route('buyNow', $product->slug) }}">Order Now</a> -->
                                        <a class="more-btn list-buy-btn" href="{{ route('ProductDetail', $product->slug) }}">View Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif




                    <!-- @if(count($results['products']) > 0)

                    <ul>
                        @foreach($results['products'] as $product)

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="list-wrapper">
                                <img src="{{asset('/uploads/product/'.$product->path.'/thumbnail/'.$product->image)}}">
                                <div class="figure-content-wrapp">

                                    <div class="product-title">
                                        <h3>{{ $product->title }}</h3>
                                    </div>



                                    <div class="lsting-btn-wrapper">
                                        <a class="more-btn list-buy-btn" href="{{route('ProductDetail', $product->slug)}}">View Product</a>
                                    </div>

                                </div>

                            </div>
                        </div>





                        @endforeach
                    </ul>
                    @endif -->

                    @if(count($results['categories']) == 0 && count($results['products']) == 0)
                    <p>No results found for the given search criteria.</p>
                    @endif
                </div>
            </div>
            @include('front.product.product-body')
    </div>
    </div>
</section>
@endsection
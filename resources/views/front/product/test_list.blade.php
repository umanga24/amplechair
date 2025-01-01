@extends('layouts.front')

@section('page_title') @endsection
@section('meta')
@include('front.include.meta')
@endsection
@section('styles')

<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/inner.css')}}">

@endsection
@section('content')
<div class="breadcrumbs overlay" data-stellar-backgroundratio="0.7" style="background-image: url('{{asset('/uploads/category/banner/'.$cat_info->image1)}}' )">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!--<ul class="list">-->
                <!--    <li><a href="/">Home</a></li>-->
                <!--    <li><a href="#">Categories</a></li>-->
                <!--</ul>-->
                <!-- <h2> @if(isset($cat_info))
                    {{ $title = $cat_info->title }}
                    @endif
                    @if(isset($child_cat))
                    {{$title = $child_cat->title}}
                    @endif
                </h2> -->
            </div>
        </div>
    </div>
</div>

<section class="listing-page">
    <div class="container">
        <h3 class="inner__page__heading__title text-center mb-2">

            @if(isset($cat_info))
            {{ $title = $cat_info->title }}
            @endif
            @if(isset($child_cat))
            {{$title = $child_cat->title}}
            @endif

        </h3>
        {!!htmlspecialchars_decode($cat_info->description)!!}
        <div class="row mt-5">
            <!--<div class="col-lg-3 col-md-4 col-12">-->
            <!--    <nav class="sidebar card pb-2 mb-4">-->
            <!--        <h5 class="py-3 pl-3">All Category</h5>-->
            <!--        <ul class="nav flex-column">-->
            <!--            @foreach($productCategories as $top_cat) -->
            <!--                <li class="nav-item">-->
            <!--                    <a class="nav-link" href="{{route('getProductByCategories', $top_cat->slug)}}">{{@$top_cat->title}}<b class="float-right">&raquo;</b> </a>-->
            <!--                    @if(count($top_cat->subcategories)>0)-->
            <!--                        <ul class="submenu dropdown-menu">-->
            <!--                            @foreach($top_cat->subcategories as $sub_cat)-->
            <!--                                <li><a class="nav-link" href="{{route('getProductByCategories', $sub_cat->slug)}}">{{@$sub_cat->title}} </a></li>-->
            <!--                                {{-- <li><a class="nav-link" href="#">Submenu item 2 </a></li>-->
            <!--                                <li><a class="nav-link" href="#">Submenu item 3 </a></li> --}}-->
            <!--                             @endforeach-->
            <!--                        </ul>-->
            <!--                    @endif-->
            <!--                </li>-->
            <!--            @endforeach-->

            <!--            {{-- <li class="nav-item">-->
            <!--                <a class="nav-link" href="#">Category 1</a>-->
            <!--            </li> --}}-->

            <!--            {{-- <li class="nav-item">-->
            <!--                <a class="nav-link" href="#">Category 3</a>-->
            <!--            </li> --}}-->

            <!--        </ul>-->
            <!--    </nav>-->
            <!--</div>-->

            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    @include('front.product.test-product-body')

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
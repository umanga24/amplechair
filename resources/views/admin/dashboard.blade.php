@extends('layouts.admin')
@section('page_title') Admin @endsection
@section('content')
<div class="page-content fade-in-up">
    <div class="row">
        <!-- <div class="col-lg-4 col-md-6">
            <a href="{{route('post.index')}}">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">{{@$blogs}} </h2>
                        <div class="m-b-5">Total Blogs </div>
                        <i class="ti-files widget-stat-icon"></i>   
                    </div>
                </div>
            </a>
        </div> -->
        <div class="col-lg-4 col-md-6">
            <a href="{{route('category.index')}}">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">  {{@$cat}}</h2>
                        <div class="m-b-5">All Category </div>
                        <i class="fa fa-sitemap widget-stat-icon"></i>   
                    </div>
                </div>
            </a>
        </div>
        <!--<div class="col-lg-4 col-md-6">-->
        <!--    <a href="{{route('product.index')}}">-->
        <!--        <div class="ibox bg-danger color-white widget-stat">-->
        <!--            <div class="ibox-body">-->
        <!--                <h2 class="m-b-5 font-strong">  {{@$products}}</h2>-->
        <!--                <div class="m-b-5">All Prdducts </div>-->
        <!--                <i class="fa fa-shopping-cart widget-stat-icon"></i>   -->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </a>-->
        <!--</div>-->
        <!-- <div class="col-lg-4 col-md-6">
            <a href="{{route('order-list')}}">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">  {{@$orders}}</h2>
                        <div class="m-b-5">All New  Orders </div>
                        <i class="fa fa-shopping-cart widget-stat-icon"></i>   
                    </div>
                </div>
            </a>
        </div> -->
        <div class="col-lg-4 col-md-6">
            <a href="{{route('slider.index')}}">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">  {{@$sliders}}</h2>
                        <div class="m-b-5">All Sliders </div>
                        <i class="fa fa-file widget-stat-icon"></i>   
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-lg-4 col-md-6">
            <a href="{{route('list-all-message')}}">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">  {{@$messages}}</h2>
                        <div class="m-b-5">All Contact Messages </div>
                        <i class="fa fa-envelope widget-stat-icon"></i>   
                    </div>
                </div>
            </a>
        </div>
        
         

    </div>
    
    
    
    <style>
        .visitors-table tbody tr td:last-child {
            display: flex;
            align-items: center;
        }

        .visitors-table .progress {
            flex: 1;
        }

        .visitors-table .progress-parcent {
            text-align: right;
            margin-left: 10px;
        }
    </style>
    
</div>
@endsection
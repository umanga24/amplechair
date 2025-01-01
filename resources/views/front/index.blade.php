@extends('layouts.front')
@section('page_title') {{@$meta_info->title}}@endsection
@section('meta')
@include('front.include.meta')
@endsection
@section('styles')

@endsection
@section('content')

@if(isset($sliders) && $sliders->count())
<!-- main slider section starts -->
<section class="slider">
    <div class="owl-carousel home_owl_slider owl-theme">
        @foreach($sliders as $slider_data)
        <div class="slider-wrapper">
            <figure style="background-image:url('{{asset('/uploads/slider/'.$slider_data->image)}}')">
                <div class="container">
                    <div class="slider-content mt-5">
                        <div class="slider-content-side">
                            {!!html_entity_decode($slider_data->sub_title)!!}
                            <h1>{{ @$slider_data->title}}</h1>
                        </div>

                        <div>
                            <!-- <a data-fancybox="video-gallery" href="https://www.youtube.com/embed/zj9ead5CHZY?si=BV-5sFcpada1FnuX"> -->

                            <!-- <div class="wrappers">
                                    <div class="circle pulse"></div>
                                    <div class="circle">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                                            <polygon points="40,30 65,50 40,70"></polygon>
                                        </svg>
                                    </div>
                                </div> -->
                            </a>
                        </div>
                    </div>
                </div>
            </figure>
        </div>
        @endforeach
    </div>
</section>
<!-- main slider section ends -->
@endif
<!--   about section starts -->

<section class="about-section">
    <div class="container">
        <!-- Title at the Top -->
        <!-- <div class="about-section-title">
            <h2>
                Ample Chair & <span>Metal Industry</span>
            </h2>
        </div> -->
        <!-- Content Row -->
        <div class="row align-items-center">
            <!-- Left Content (Description) -->
            <div class="col-md-6 wow animate__fadeIn" data-duration="2s">
                <h2><b>
                        Ample Chair & <span>Metal Industry</b></span>
                </h2>
                <p class="about-section-description">
                    {!! str_limit(html_entity_decode(@$about_page->summary), 700) !!}
                </p>
            </div>
            <!-- Right Content (Image) -->
            <div class="col-md-6 text-center wow animate__fadeIn" data-duration="2s">
                <div class="about-section-image">
                    <img src="{{ asset('banner/display.jpg') }}" alt="Ample Chair" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>



<section class="wall-section pt-0" style="">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-wrapper  about-section-title text-center">
                    <h2>Our New <span>Products</span> </h2>
                </div>
            </div>
        </div>
        <div class="row">

            @if(isset($productss) && $products->count())
            @foreach($productss as $product)

            <div class="col-lg-3 col-md-5 col-12">
                <div class="wall-wrapper">
                    <div class="wall-image">
                        <img src="{{ asset('/uploads/product/'.$product->path.'/thumbnail/'.$product->image) }}" height="200">
                    </div>
                    <div class="wall-content">
                        <div class="product-title">
                        <h3>{{$product->title}}</h3>
                        </div>
                        <div class="lsting-btn-wrapper">

                            <a class="view-pro-btn more-btn" href="{{ route('ProductDetail', $product->slug) }}">View Product</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif


        </div>
        <div class="more">


            <a href="{{ route('allProducts') }}">
                <h5>View All Products-- >></h5>

            </a>

            <div>
            </div>
</section>




<!-- <section class="wall-section pt-0" style="">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-wrapper  about-section-title text-center">
                    <h2>Our <span>Products</span> </h2>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- @foreach($allCategories as $all_category)

            <div class="col-lg-4 col-md-6 col-12">
                <div class="wall-wrapper wow animate__fadeIn" data-wow-duration="2s">
                    <img src="{{asset('/uploads/category/banner/'.$all_category->image)}}">
            <div class="wall-content">
                <h3>{{ $all_category->title }}</h3>
                <div class=" rate-devider">
                    <a href="">Know More</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach --}}


    {{-- @if(isset($frontcategories) && $frontcategories->count()) --}}
    @if(isset($frontcategories) && $frontcategories->count())
    @foreach($frontcategories as $top_cat)
    {{-- {{dd($frontcategories)}} --}}
    <div class="col-lg-4 col-md-6 col-12">
        <div class="wall-wrapper">
            <img src=" {{asset('/uploads/category/banner/'.$top_cat->image)}}">
            <div class="wall-content">
                <h3>{{@$top_cat->title}}</h3>
                <div class=" rate-devider">



                    <a href="{{route('getProductByCategories',$top_cat->slug)}} ">Know More</a>


                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif



    </div>

    </div>
</section> -->


<!-- <section class="good-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-wrapper  about-section-title text-center">
                    <h2>Goodness of <span>Nepal</span> </h2>
                </div>
            </div>
        </div>
        {{-- @foreach ($quotes as $index=>$quote)
        @if ($index[0]) --}}

        <div class="row align-items-center">

            <div class="col-md-6">
                @if (isset($quotes[0]) && $quotes[0] != null)

                <div class="img-container">
                    <img class="good-img" src="{{asset($quotes[0]->quote_image)}}">
                </div>
                @else
                <p>No Content</p>
                @endif

            </div>
            <div class="col-md-6 mt-lg-0 mt-4">
                @if (isset($quotes[0]) && $quotes[0] != null)
                <div class="good text-container ">
                    <h3 class="mb-3 sub-title">{{$quotes[0]->quote_title}}</h3>
                    <p>{!!$quotes[0]->quote_description!!}</p>
                </div>
                @else
                <p>No Content</p>
                @endif


            </div>
        </div>







        <div class="row align-items-center">
            <div class="col-md-6 order-lg-1 order-2 mt-lg-0 mt-4">
                @if (isset($quotes[0]) && $quotes[0] != null)

                <div class="good text-container ">
                    <h3 class="mb-3 sub-title">{{$quotes[1]->quote_title}} </h3>
                    <p>{!!$quotes[1]->quote_description!!}</p>
                </div>
                @else
                <p>No Content</p>
                @endif

            </div>
            <div class="col-md-6 order-lg-2 order-1">
                @if (isset($quotes[0]) && $quotes[0] != null)

                <div class="img-container">
                    <img class="good-img" src="{{asset($quotes[1]->quote_image)}}">
                </div>
                @else
                <p>No Content</p>
                @endif

            </div>
        </div>


    </div>
</section> -->

<section class="good-section" style="background-image:url(https://barahsinghe.com/wp-content/themes/starter/imagio_s/img/texture/background_texture.png)">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-wrapper  about-section-title text-center">
                    <h2>Our <span>Services</span> </h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="img-container">
                    <img class="good-img" src="{{asset('services/office.jpeg')}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="good text-container ">
                    <h3 class="mb-3 sub-title">Office Chair</h3>
                    <p>Our Office Chairs are designed to maximize comfort, support, and productivity. Featuring ergonomic designs, adjustable heights, lumbar support, and premium materials, they ensure a perfect fit for any workspace. Whether you’re furnishing a corporate office or your home workspace, our chairs combine style and functionality to keep you comfortable through long hours of work. Choose from a range of modern designs, durable builds, and customizable options to create the ideal office environment.</p>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="good text-container ">
                    <h3 class="mb-3 sub-title">Hotel and Banquet Chair</h3>
                    <p>Our Hotel and Banquet Chairs are crafted to add elegance, comfort, and durability to any venue. Perfect for weddings, conferences, and fine dining, these chairs feature stylish designs, sturdy construction, and premium finishes that elevate the ambiance of your space. Lightweight yet robust, they are easy to handle and stack for efficient storage. With a variety of designs and customizable options, our chairs seamlessly blend functionality and sophistication, making them an ideal choice for hotels, banquet halls, and event venues.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="img-container">
                    <img class="good-img" src="{{asset('services/hotel.jpeg')}}">
                </div>
            </div>
        </div>



        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="img-container">
                    <!-- <img src="{{ asset('banner/display.jpg') }}" alt="Ample Chair" class="img-fluid"> -->
                    <img class="good-img" src="{{asset('services/game.jpg')}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="good text-container ">
                    <h3 class="mb-3 sub-title">Gaming Chair</h3>
                    <p>Our Gaming Chairs are designed to provide ultimate comfort and support during long gaming sessions. Engineered with ergonomic features like adjustable armrests, lumbar support, reclining backrests, and high-density foam cushioning, these chairs ensure you stay focused and relaxed. Built with durable materials and sleek designs, they combine style with functionality. Whether you're a casual gamer or a pro, our gaming chairs deliver the perfect balance of comfort and performance to level up your experience.</p>
                </div>
            </div>
        </div>



        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="good text-container ">
                    <h3 class="mb-3 sub-title">Chair Reparing</h3>
                    <p>Our Chair Repairing Services are dedicated to restoring your chairs to their original comfort and functionality. Whether it’s fixing broken frames, replacing upholstery, or adjusting mechanisms, we ensure high-quality repairs using durable materials and skilled craftsmanship. From office chairs to dining and event chairs, we handle a wide range of repairs to extend the life of your furniture. Trust us to bring your chairs back to life with reliable and efficient service.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="img-container">
                    <img class="good-img" src="{{asset('services/repair.jpeg')}}">
                </div>
            </div>
        </div>


    </div>
</section>




<!-- <section class="certifcation-section" style="">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-wrapper  about-section-title text-center">
                    <h2>Certification & <span>Recognization</span> </h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mt-lg-5 mt-0">
            @foreach ($recognizations as $recognization)


            <div class="col-md-2 col-2">
                <div class="img-container">
                    <a class="text-center" href="{{$recognization->link}}">
                        <img class="mr-3" src="{{asset($recognization->image2)}}">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> -->

{{-- <section class="certifcation-section" style="">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title-wrapper  about-section-title text-center">
                    <h2>Certification & <span>Recognization</span> </h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mt-5">
            <div class="col-md-2">
                <div class="img-container">
                    <a href="">
                    <img class="" src="{{asset('assets/front/images/usda.png')}}">
</a>
</div>
</div>
<div class="col-md-2">
    <div class="img-container">
        <a href="">
            <img class="" src="{{asset('assets/front/images/eu-organic.png')}}">
        </a>
    </div>
</div>
<div class="col-md-2">
    <div class="img-container">
        <a href="">
            <img class="" src="{{asset('assets/front/images/rainforest.png')}}">
        </a>
    </div>
</div>
<div class="col-md-2">
    <div class="img-container">
        <a href="">
            <img class="" src="{{asset('assets/front/images/kosher.png')}}">
        </a>
    </div>
</div>
<div class="col-md-2">
    <div class="img-container">
        <a href="">
            <img class="" src="{{asset('assets/front/images/fairtrade-1.png')}}">
        </a>
    </div>
</div>
</div>
</div>
</section> --}}







<!-- blogs section start  -->
<!-- <section class="blog-section">
    <div class="container">
        <div class="about-section-title">
            <h2 class="text-center">News & <span>Blogs</span></h2>
        </div>
        <div class="row mt-4">
            @if(isset($all_post) && $all_post->count())
            @foreach($all_post as $post_data)
            <div class="mx-auto mb-4 col-lg-4 col-sm-12">
                <div class="card blog-section-card border-0 shadow-sm">
                    <a href="{{route('PostDetail', $post_data->slug)}}">
                        <img src="{{asset('/uploads/blog/banner/'.$post_data->thumbnail)}}" alt="" class="card-img img-fluid">
                    </a>
                    <div class="card-body px-3">
                        <a href="{{route('PostDetail', $post_data->slug)}}">
                            <h5 class="card-title">{{$post_data->title}}</h5>
                        </a>
                        <p class="card-description">
                            {{ str_limit(@$post_data->summary, 80)  }}

                        </p>
                        <a href="{{route('PostDetail', $post_data->slug)}}" class="btn btn-blog">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <div class="text-center mt-4">
            <a href="{{route('blogs')}}" class="btn-blog">View More</a>
        </div>
    </div>
</section> -->
<!-- blogs section end  -->


@endsection
@section('scripts')

<script>
    $(document).ready(function() {
        $('#subscribe-form').on('submit', function(e) {
            $('.subscribeme').attr('disabled', 'disabled');
            e.preventDefault();
            $.ajax({
                url: "{{route('addSubscriber')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.status == false) {
                        $('.subscribeme').removeAttr('disabled', 'disabled');
                        FailedResponseFromDatabase(response.message);
                    }
                    if (response.status == true) {
                        $('#sub_email').val('');
                        $('#sub_full_name').val('');
                        DataSuccessInDatabase(response.message);
                        setTimeout(function() {

                            location.reload("{{route('blogs')}}");
                        }, 2500);
                    }
                }
            });
        })
    })
</script>
@endsection
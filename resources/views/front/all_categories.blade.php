@extends('layouts.front')
@section('page_title') {{@$page_info->meta_title}}@endsection
@section('meta')
@include('front.include.meta')
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/inner.css')}}">

@endsection
@section('content')
<section class="contact-page pb-0">
   <div class="contact-top-image" style="background-image:url({{asset('/uploads/page/'.$page_info->thumbnail)}})">
       <!--{{asset('/uploads/page/'.$page_info->thumbnail)}}-->
       <!--{{asset('/uploads/category/banner/'.$all_category->image)}}-->
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <div class="contact-title">
                        <li><a href="{{route('allCategories')}}" class="text-capitalize"><h2>All categories</h2></a></li>
                        <ul class="list mt-4">
                            <li><a href="{{route('homepage')}}">Home</a></li>
                            <span class="mx-2"><i class="fa fa-chevron-right text-white"></i></span>
                            <li><a href="{{route('allCategories')}}" class="text-capitalize">Categories</a></li>
                        </ul>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="container">
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
            <div class="row">
                @foreach($allCategories as $all_category)
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card category-card border-0">

                        @if ($all_category->image !== null)
                        <a href="{{route('getProductByCategories', $all_category->slug)}}" class="ttl-link">
                            <img src="{{asset('/uploads/category/banner/'.$all_category->image)}}" alt="" class="card-img img-fluid">
                            <!-- <div class="ttl">
                                <span class="tt-big"><strong>{{ $all_category->title }}</strong></span>
                            </div> -->
                        </a>
                        @else

                        <a href="{{route('getProductByCategories', $all_category->slug)}}" class="ttl-link">
                            <img src="{{asset('assets/admin/images/default.png')}}" alt="" class="card-img img-fluid">
                            <!-- <div class="ttl">
                                <span class="tt-big"><strong>{{ $all_category->title }}</strong></span>
                            </div> -->
                        </a>
                        @endif
                        {{-- && ($products->count() --}}
                        {{-- @if($all_category->id = $all_category->parent_id) --}}
                         {{-- @if($all_category->parent_id == null) --}}

                         @if($all_category->is_parent == 1)
                            <a class="more-btn list-buy-btn" href="{{route('getSubcategories', $all_category->slug)}}">View Sub-Category</a>
                        @endif

                    </div>
                </div>
                @endforeach
            </div>
            <!-- <div class="row">
                @foreach($allCategories as $all_category)
                    <div class="col-lg-3 col-md-6 col-12 mx-auto">
                        <div class="list-wrapper">
                            <img src="{{asset('/uploads/category/banner/'.$all_category->image)}}">
                            <div class="figure-content-wrapp">
                                <h3>{{ $all_category->title }}</h3>
                                {{-- <div class="price-tag-wrap">
                                    <span>$ 20
                                        <p>
                                        @if($all_category->discount > 0)
                                            $ 200
                                        @endif
                                        </p>
                                    </span>
                                    @if($all_category->discount > 0)
                                    <p> 10 % OFF</p>
                                    @endif
                                </div> --}}
                                <div class="lsting-btn-wrapper">
                                    @if ($all_category->parent_id !== null)
                                        <a class="more-btn list-buy-btn" href="">View Sub-Category</a>
                                    @endif
                                    <a class="view-pro-btn more-btn" href="{{route('getProductByCategories', $all_category->slug)}}">View Product</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
            </div> -->
            {{ $allCategories->links() }}
        </div>
    </section>

   </div>
</section>

@endsection
@section('scripts')
<script>
    $(document).ready(function(){
		$('#contact_us').one('click', function(e){
			e.preventDefault();
            $('#contact_us').html('Submitting.....');
			var feedback = $('#contact-submit').serialize();
			if (feedback) {
        		$.ajax({
        			url:"{{route('ajax-submit-contact')}}",
        			method:"POST",
        			data:{
        				contact: feedback,
        				_token : "{{csrf_token()}}",
        			},
        			success: function(response){
        				if (response.status == false) {
        					FailedResponseFromDatabase(response.message);
                            $('#contact_us').html('Send Message');
        				}
        				if (response.status == true) {
        				    $('#name').val('');
                            $('#email').val('');
                            $('#phone_num').val('');
                            $('#message').val('');
                            $('#contact_us').html('Message Sent').attr('disabled', 'disabled');
        					DataSuccessInDatabase(response.message);
        				}
        			}
        		});
        	}
		})
	})

</script>
@endsection

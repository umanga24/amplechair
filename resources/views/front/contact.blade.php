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
   <!--<div class="contact-top-image" style="background-image:url()">-->
     @foreach ($banners as $banner)
    <div class="breadcrumbs overlay" data-stellar-background-ratio="0.7"
    style="background-image: url({{ asset($banner->contact_banner) }});">
   @endforeach
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <div class="contact-title">
                       <!--<ul class="list mt-4">-->
                       <!--     <li><a href="{{route('homepage')}}">Home</a></li>-->
                            <!--<span class="mx-2"><i class="fa fa-chevron-right text-white"></i></span>-->
                       <!--     <li><a href="#">Contact us</a></li>-->
                       <!-- </ul>-->
                        <h2>Contact us</h2>
                        
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="container pt-5">
       <div class="row">
        <div class="col-lg-4 col-md-4 col-12">
               <div class="contact-address">
                   <h3>Contact Info</h3>
                   <ul>
                       <li> <i class="fa fa-map-marker" aria-hidden="true"></i>  {{@$web_detail->location}}</li>
                       <li><i class="fa fa-phone-square" aria-hidden="true"></i>{{@$web_detail->phone_one}} {{(@$web_detail->phone_two) ? ','.@$web_detail->phone_two : '' }}</li>
                       <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{@$web_detail->email}}">{{@$web_detail->email}}</a></li>
                   </ul>
               </div>
           </div>
           <div class="col-lg-8">
               <form   class="contact-form"  id="contact-submit" method="POST">
                    <input type="hidden" name="feedback" value="contact">
                    <input type="text" placeholder="Name"  name="name" id="name">
                    <input type="email" placeholder="Email" name="email" id="email">
                    <input type="number" placeholder="Phone" name="phone" id="phone_num">
                    <textarea placeholder="Message" name="message" id="message" ></textarea>
                    <div class="text-center mt-4">
                    <button type="button" id="contact_us" class="btn-blog">Send Message</button>
                    </div>
               </form>
           </div>

       </div>
   </div>
  <div class="map-wrap" class="mt-5">
    <iframe src="{{@$web_detail->map }}" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
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

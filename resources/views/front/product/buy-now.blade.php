@extends('layouts.front')
@section('page_title') {{@$product_info->title}}  @endsection
@section('meta')
@include('front.include.meta')
@endsection
@section('styles')
 
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/inner.css')}}">

@endsection
@section('content')
<section class="buy-form">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="whole-form-wrapper">
                        <div class="buy-image">
                            <img src="{{asset('/uploads/product/'.$product_info->path.'/thumbnail/'.$product_info->image)}}">
                        </div>
                        <div class="product-name">
                            <h4>{{@$product_info->title}}</h4>
                        </div>
                        <form action="" class="buy-form-details" id="submitForm" method="post">
                            {{@csrf_field()}}
                            <input type="text" placeholder="Name" name="name" id="name">
                            <input type="email" placeholder="Email" name="email" id="email">
                            <input type="text" placeholder="Location" name="location" id="location">
                            <input type="number" placeholder="Phone" name="phone" id="phone">
                            <textarea placeholder="Message" name="message" id="message"></textarea>
                            <input type="hidden" id="id" name="id" value="{{@$product_info->id}}">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-6">
                                    <div class="quantity-wrapper">
                                        <label>Quantity</label>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-6 col-6">
                                    <div class="quantity-wrapper">
                                        <input type="number" id="quantity" name="quantity" placeholder="your quantity">
                                    </div>
                                </div>
                            </div>
                            <button id="submitOrder" type="submit">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('#submitOrder').click(function(e){
            e.preventDefault();
            $('#submitOrder').html('Submitting.....').attr('disabled', 'disabled');
            var order = $('#submitForm').serialize();
 
            $.ajax({
                url:"{{route('SubmitOrder')}}",
                method:"POST",
                data:{
                    order: order,
                    _token : "{{csrf_token()}}",
                },
                success: function(response){
                    if (response.status == false) {
                        FailedResponseFromDatabase(response.message);
                        $('#submitOrder').html('Send Order Request').removeAttr('disabled', 'disabled');
                    }
                    if (response.status == true) {
                        $('#name').val('');
                        $('#email').val('');
                        $('#phone').val('');
                        $('#message').val('');
                        $('#location').val('');
                        $('#quantity').val('');
                        $('#submitOrder').html('Order request sent').attr('disabled', 'disabled');                            
                        DataSuccessInDatabase(response.message);
                    }
                }
            });
 
        })
    })
</script>
@endsection
 
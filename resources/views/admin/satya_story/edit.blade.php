@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>About Us </h1>
                    <a href="/about_us"class="float-end btn btn-info">Back</a>

                </div>

                <div class="card-body">

                    <form action="/about_us/{{$about_us->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')


                        <div class="form-group">
                            <label for="description">About Description</label>
                            <textarea id="description" class="form-control" name="satya_description" rows="3" placeholder="enter satya_story description">{!! $about_us->satya_description !!}</textarea>
                        </div>

                        
                        <div class="form-group">
                            <label for="desc1">Our Core Value Description</label>
                            <textarea id="desc1" class="form-control" name="desc1" rows="3" placeholder="enter our value description">{!! $about_us->desc1 !!}</textarea>
                        </div>

                        
                        <div class="form-group">
                            <label for="desc2">Why Choose Us Description</label>
                            <textarea id="desc2" class="form-control" name="desc2" rows="3" placeholder="enter whychoose us description">{!! $about_us->desc2 !!}</textarea>
                        </div>

                        
                        <div class="form-group">
                            <label for="desc3">Our Journey Description</label>
                            <textarea id="desc3" class="form-control" name="desc3" rows="3" placeholder="enter our journey description">{!! $about_us->desc3 !!}</textarea>
                        </div>



                        <div class="form-group">
                            <label for="image">Image for About</label>
                            <div class="my-2">
                                <img src="{{asset($about_us->image)}}" height="120" width="120" alt="">
                             </div>
                            <input id="image" class="form-control" type="file" name="image" placeholder="enter image">
                        </div>

                        <div class="form-group">
                            <label for="image1">Image for Core Values</label>
                            <div class="my-2">
                                <img src="{{asset($about_us->image1)}}" height="120" width="120" alt="">
                             </div>
                            <input id="image1" class="form-control" type="file" name="image1" placeholder="enter image">
                        </div>

                        <div class="form-group">
                            <label for="image2">Image of whychoose us</label>
                            <div class="my-2">
                                <img src="{{asset($about_us->image2)}}" height="120" width="120" alt="">
                             </div>
                            <input id="image2" class="form-control" type="file" name="image2" placeholder="enter image">
                        </div>

                        <div class="form-group">
                            <label for="image3">Image for Our Journy</label>
                            <div class="my-2">
                                <img src="{{asset($about_us->image3)}}" height="120" width="120" alt="">
                             </div>
                            <input id="image3" class="form-control" type="file" name="image3" placeholder="enter image">
                        </div>


                        <div class="form-group">
                            <label for="satya_banner">Banner Image</label>
                            <div class="my-2">
                                <img src="{{asset($about_us->satya_banner)}}" height="120" width="120" alt="">
                             </div>
                            <input id="satya_banner" class="form-control" type="file" name="satya_banner" placeholder="enter image">
                        </div>










                        <button type="submit" class="btn btn-info">Update</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    function showThumbnail(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
        }
        reader.onload = function(e){
            $('#thumbnail').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }


</script>
<script src="//cdn.ckeditor.com/4.9.1/full/ckeditor.js"></script>
<script type="text/javascript" src="{{asset('/assets/admin/js/laravel-file-manager-ck-editor.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/admin/js/datepicker.js')}}"></script>
<script>


    Ckeditor('description', 250);
    Ckeditor('desc1', 250);

    Ckeditor('desc2', 250);

    Ckeditor('desc3', 250);



    $(document).ready(function() {
        $('#published_date').datepicker({theme:'green', outputFormat: 'y-MM-dd'});
        $('#published_date').keypress(function(event){
            event.preventDefault();
        })
    });


    $(document).ready(function(){
        $('#create_url').keyup(function(e){
            var url = "{{route('homepage')}}";
            if (e.shiftKey || e.altKey || e.keyCode == 32) {
                e.preventDefault();
            } else{
                var key = e.keyCode;
                if ( ( key >= 48 && key <= 58 ) || ( key >= 66 && key <= 90 )  || key == 189 || key == 8){
                    var slug =$(this).val();
                    $.ajax({
                        method:"post",
                        url: "{{route('checkBlogSlug')}}",
                        data:{
                            slug:slug,
                            _token:"{{csrf_token()}}",
                            id: "{{@$post_info->id}}",
                        },
                        success:function(response){
                            if (response.status == true) {
                                url = url+'/blog/'+response.slug;
                                $('.message_for_slug_error').addClass('display_none');
                                $('.message_for_slug').removeClass('display_none').html('<p> <i class="fa fa-check"></i> '+response.message+'</p>');
                                $('#updated_url').html(url);
                            }
                            if (response.status == false) {
                                $('.message_for_slug').addClass('display_none');
                                $('.message_for_slug_error').removeClass('display_none').html('<p> <i class="fa fa-times"></i> '+response.message+'</p>');
                                $('#updated_url').html(url+'/blog/'+"{{@$post_info->slug}}");
                                $('#create_url').val("{{@$post_info->slug}}");
                                FailedResponseFromDatabase(response.message);
                            }
                        }
                    })


                } else {
                    e.preventDefault();
                }
            }
        })

    })
    function FailedResponseFromDatabase(message){
        html_error = "";
        $.each(message, function(index, message){
            html_error += '<p class ="error_message text-left"> <span class="fa fa-times"></span> '+message+ '</p>';
        });
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            html:html_error ,
            confirmButtonText: 'Close',
            timer: 10000
        });
    }
    function DataSuccessInDatabase(message){
        Swal.fire({
            // position: 'top-end',
            type: 'success',
            title: 'Done',
            html: message ,
            confirmButtonText: 'Close',
            timer: 10000
        });
    }


</script>

@endsection

@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Quote</h1>
                    <a href="/quote"class="float-end btn btn-info">Back</a>

                </div>

                <div class="card-body">

                    <form action="/quote/{{$quote->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="quote_title">Quote_title</label>
                            <input id="quote_title" class="form-control" type="text" name="quote_title" placeholder="enter quote_title" value="{{$quote->quote_title}}">
                        </div>

                        <div class="form-group">
                            <label for="quote_description">Quote_Description</label>
                            <textarea id="description" class="form-control" name="quote_description" rows="3" placeholder="enter quote description">{!! $quote->quote_description !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="quote_image">Image</label>
                            <div class="my-2">
                                <img src="{{asset($quote->quote_image)}}" height="120" width="120" alt="">
                             </div>
                            <input id="quote_image" class="form-control" type="file" name="quote_image" placeholder="enter image">
                        </div>

                        {{-- <div class="form-group">
                            <label for="link">Link</label>
                            <input id="link" class="form-control" type="text" name="link" placeholder="enter link" value="{{$quote->link}}">
                        </div>

                        <div class="form-group">
                            <label for="image2">Image</label>
                            <div class="my-2">
                                <img src="{{asset($quote->image2)}}" height="120" width="120" alt="">
                             </div>
                            <input id="image2" class="form-control" type="file" name="image2" placeholder="enter image"  value="{{$quote->image2}}">
                        </div> --}}










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

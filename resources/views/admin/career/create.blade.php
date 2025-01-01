@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                 <h1>Career</h1>
                    <a href="/position" class="btn btn-info float-end">Back</a>

                </div>

                <div class="card-body">

                    <form action="/position" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="post_title">Post_title</label>
                            <input id="post_title" class="form-control" type="text" name="post_title" placeholder="enter post_title">
                        </div>

                        <div class="form-group">
                            <label for="post_description">Equirements</label>
                            <textarea id="description" class="form-control" name="post_description" rows="3"></textarea>
                        </div>



                       <div class="row">
                        <div class="col-md-6">
                         <div class="form-group">
                             <label for="banner_image">Banner_image</label>
                             <div class="my-2">

                                @if ($position!=null)
                                <img src="{{asset($position->banner_image)}}" height="120" width="120" alt="">
                            @else
                                <p>No Image</p>
                            @endif

                            </div>
                             <input id="banner_image" class="form-control" type="file" name="banner_image" placeholder="enter banner_image">
                         </div>
                        </div>

                        {{-- <div class="col-md-6">
                         <div class="form-group">
                             <label for="banner_image">Banner_image</label>
                             <input id="banner_image" class="form-control" type="file" name="banner_image" placeholder="enter banner_image">
                         </div>
                        </div> --}}
                        </div>

                        <button type="submit" class="btn btn-info">Submit</button>

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



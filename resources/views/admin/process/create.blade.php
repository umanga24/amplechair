@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                            <h1>Process</h1>
                    <a href="/operation" class="float-end btn btn-info">Back</a>

                </div>

                <div class="card-body">

                    <form action="/operation" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="process_title">Process_title</label>
                            <input id="process_title" class="form-control" type="text" name="process_title" placeholder="enter process_title">
                        </div>

                 <div class="form-group">
                    <label for="process_description">Description</label>
                    <textarea id="description" class="form-control" name="process_description" rows="3"></textarea>
                 </div>


                       <div class="row">
                        <div class="col-md-6">
                         <div class="form-group">
                             <label for="process_image">Image</label>
                             <input id="process_image" class="form-control" type="file" name="process_image" placeholder="enter process_image">
                         </div>
                        </div>

                        <!--<div class="col-md-6">-->
                        <!-- <div class="form-group">-->
                        <!--     <label for="process_banner_image">Banner Image</label>-->
                        <!--     <div class="my-2">-->
                        <!--        <img src="{{asset($operation->process_banner_image)}}" height="120" width="120" alt="">-->
                        <!--    </div>-->
                        <!--     <input id="process_banner_image" class="form-control" type="file" name="process_banner_image" placeholder="enter process_banner_image">-->
                        <!-- </div>-->
                        <!--</div>-->

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


@extends('layouts.admin')
@section('page_title') {{ ($images->count() >0) ? "Update" : "Add New"}} Gallery Images @endsection
<link href="{{asset('/assets/admin/js/plugins/fine-uploader/fine-uploader-gallery.css')}}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('/assets/admin/css/jquery-ui.css')}}">
@section('content')

<div class="page-heading">
    <h1 class="page-title"> Galleries </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Home</a>
        </li>
        <li class="breadcrumb-item"> {{ ($images->count() > 0) ? "Update" : "Add New "}} Gallery Images </li>
    </ol>

</div>
@include('admin.section.notifications')
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">{{ ($images->count() > 0) ? "Update" : "Add New "}} Gallery Images</div>
            <div>
                <a class="btn btn-info btn-md" href="{{route('gallery.index')}}">All Galleries List</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Gallery Information</div>
                            <div class="ibox-tools">

                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 form-group">
                                    <label>Title <span class="required_field">*</span></label>
                                    <input class="form-control" disabled type="text" value="{{(@$gallery_info->title) ? @$gallery_info->title : old('title')}}" name="title" placeholder="Title Here">
                                    @if($errors->has('title'))
                                    <div class="error alert-danger">{{$errors->first('title')}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <form class="form form-responsive form-horizontal dropzone" action="{{route('gallery-images.update', $gallery_info->id)}}" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        {{csrf_field()}}

                    </form>
                  
                    <div class="ibox">
                        <div class="ibox-body">
                            <div class="row" id="updated_image_list">
                                @include('admin.gallery.replace-image')
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-lg-3">
                <div class="ibox">
                    <div class="ibox-body">
                        <div class="form-group">
                            <label> Main Image</label>
                        </div>
                        @php
                        $thumbnail = asset('assets/admin/images/default.png');
                        @endphp
                        @if(isset($gallery_info->thumbnail) && !empty($gallery_info->thumbnail) && file_exists(public_path().'/uploads/gallery/'.$gallery_info->path.'/'.$gallery_info->thumbnail))
                        @php
                        $thumbnail = asset('/uploads/gallery/'.$gallery_info->path.'/'.$gallery_info->thumbnail);
                        @endphp
                        @endif
                        <div class="form-group">
                            <div class="m-r-10">
                                <img src="{{$thumbnail}}" alt="No Image" class=" img img-thumbnail  img-sm rounded" id="thumbnail">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <select class="form-control" name="status" disabled>
                                <option value="Publish" {{@($gallery_info->status == "Publish") ? "selected" :""}} disabled>Published</option>
                                <option value="Unpublish" {{@($gallery_info->status == "Unpublish") ? "selected" :""}} disabled>Unpublished</option>
                            </select>
                        </div>
                        @if($errors->has('status'))
                        <div class="error alert-danger">{{$errors->first('status')}}</div>
                        @endif
                        <div class="form-group">
                            <button class="btn btn-success" id="uploadImage" type="submit"> <span class="fa fa-send"></span> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>

@endsection
@section('scripts')
<script src="{{asset('/assets/admin/js/dropzone.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/admin/js/sweetalert.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/admin/js/jquery-ui.js')}}"></script>

<script>
    $(document).ready(function() {

        $( function() {
        $( "#sortable " ).sortable();
        $( "#sortable" ).disableSelection();
    });




        $('body').on('click', '.delete_image', function(e) {
            e.preventDefault();
            var image_id = $(this).data('image_id');
            // alert(image_id);
            $.ajax({
                url: "{{route('deleteGalleryImageById')}}",
                method: "GET",
                data: {
                    id: image_id,
                    _token: "{{csrf_token()}}"
                },
                success: function(response) {
                    if (response.status == false) {
                        FailedResponseFromDatabase(response.message);
                    }
                    if (response.status == true) {
                        $('.image_id' + image_id).fadeOut(1500);
                        DataSuccessInDatabase(response.message);
                    }
                }
            })
        })
    })
        Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone(".dropzone", { 
            autoProcessQueue: false,
            parallelUploads: 10, // Number of files process at a time (default 2)
            success:function(file, response, data){
               
                if(response.status == true){
                    // DataSuccessInDatabase(response.message);
                    var gallery_id = "{{$gallery_info->id}}";
                    $.ajax({
                        url: "{{route('getAllImagesByGalleryId')}}",
                        method:'GET',
                        data: {id: gallery_id},
                        success:function(response){
                            if(response.status== true){
                                $('#updated_image_list').html(response.data);
                            }else if(response.status == false){

                            }
                        }
                    })
                }else if(response.status == false ){
                    FailedResponseFromDatabase(response.message);
                }
                    
            }
             
        });

        $('#uploadImage').click(function(){
            myDropzone.processQueue();
        });

     

    function FailedResponseFromDatabase(message) {
        html_error = "";
        $.each(message, function(index, message) {
            html_error += '<p class ="error_message text-left"> <span class="fa fa-times"></span> ' + message + '</p>';
        });
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            html: html_error,
            confirmButtonText: 'Close',
            timer: 10000
        });
    }

    function DataSuccessInDatabase(message) {
        Swal.fire({
            // position: 'top-end',
            type: 'success',
            title: 'Done',
            html: message,
            confirmButtonText: 'Close',
            timer: 10000
        });
    }
</script>

@endsection
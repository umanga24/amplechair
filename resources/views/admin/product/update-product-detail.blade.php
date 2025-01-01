@extends('layouts.admin')
@section('page_title') {{ ($product_info) ? "Update" : "Add"}} Product @endsection
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" rel="stylesheet">
@endsection
@section('content')

<div class="page-heading">
    <h1 class="page-title">  Product</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Home</a>
        </li>
        <li class="breadcrumb-item"> {{ ($product_info) ? "Update" : "Add"}} Product</li>
    </ol>

</div>
@include('admin.section.notifications')
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">{{ ($product_info) ? "Update" : "Add"}} Product</div>
            <div>
                <a class="btn btn-info btn-md" href="{{route('product.index')}}">All Products</a>
            </div>
        </div>
    </div>
<!--{{--dd($product_info)--}}-->

    <form class="form form-responsive form-horizontal" action="{{route('product-update', $product_info->id)}}" enctype= "multipart/form-data" method="post">


    {{csrf_field()}}
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Product Information</div>
                        </div>
                        <div class="ibox-body">
                            <div class="row">
                                <div class="col-lg-4 col-sm-12 form-group">
                                    <label><strong>Product Title</strong></label>
                                    <input class="form-control" type="text" value="{{ (@$product_info->title) ?  @$product_info->title: old('title')}}"  disabled>

                                    @if($errors->has('title'))
                                    <div class="error alert-danger">{{$errors->first('title')}}</div>
                                    @endif
                                </div>


                                <div class="col-lg-2 col-sm-12 form-group">
                                    <label><strong>   Price</strong></label>
                                    <input class="form-control" type="text" value="{{ (@$product_info->price) ?  @$product_info->price: old('price')}}" disabled>

                                    @if($errors->has('price'))
                                    <div class="error alert-danger">{{$errors->first('price')}}</div>
                                    @endif
                                </div>


                               <div class="col-lg-12 col-sm-12 form-group">
                                    <label><strong>Description</strong></label>
                                    <textarea name="description" id="description"   rows="5" placeholder="description Here" class="form-control" style="resize: none;">{{ (@$product_info->description) ?  @html_entity_decode($product_info->description): old('description')}}</textarea>
                                    @if($errors->has('description'))
                                    <div class="error alert-danger">{{$errors->first('description')}}</div>
                                    @endif
                                </div> 


                                {{-- <div class="col-lg-3 col-sm-12 form-group">
                                    <label><strong>  Brand</strong></label>
                                    <input class="form-control" type="text" value="{{ (@$product_info->brand) ?  @$product_info->brand: old('brand')}}" disabled>

                                    @if($errors->has('brand'))
                                    <div class="error alert-danger">{{$errors->first('brand')}}</div>
                                    @endif
                                </div> --}}

                                {{-- <div class="col-lg-3 col-sm-12 form-group">
                                    <label><strong>  Model</strong></label>
                                    
                                    <input class="form-control" type="text" value="{{ (@$product_info->model) ?  @$product_info->model: old('model')}}" disabled>

                                    @if($errors->has('model'))
                                    <div class="error alert-danger">{{$errors->first('model')}}</div>
                                    @endif
                                </div> --}}


                                <div class="col-lg-6 col-sm-12 form-group">
                                    <label><strong>Product Highlights</strong></label>
                                    <textarea name="highlight" id="highlight"   rows="5" placeholder="Product Highlights Here" class="form-control" style="resize: none;">{{ (@$product_info->highlight) ?  @html_entity_decode($product_info->highlight): old('highlight')}}</textarea>
                                    @if($errors->has('highlight'))
                                    <div class="error alert-danger">{{$errors->first('highlight')}}</div>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-sm-12 form-group">
                                    <label><strong>Product Summary</strong></label>
                                    <textarea name="summary" id="summary"   rows="5" placeholder="Product Summary Here" class="form-control" style="resize: none;">{{ (@$product_info->summary) ?  @html_entity_decode($product_info->summary): old('summary')}}</textarea>
                                    @if($errors->has('summary'))
                                    <div class="error alert-danger">{{$errors->first('summary')}}</div>
                                    @endif
                                </div>


                                
                                

                                <!--<div class="form-group">-->
                                <!--    <label for="description">Description</label>-->
                                <!--    <textarea id="description" class="form-control" name="description" rows="3">{{$product_info->description}}</textarea>-->
                                <!--</div>-->
                                
                                <!--{{-- <div class="col-lg-12 col-sm-12 form-group">-->
                                <!--    <label><strong>Description</strong></label>-->
                                <!--    <textarea name="description" id="description"   rows="5" placeholder="description Here" class="form-control" style="resize: none;">{{$product_info->description}}</textarea>-->
                                <!--    @if($errors->has('description'))-->
                                <!--    <div class="error alert-danger">{{$errors->first('description')}}</div>-->
                                <!--    @endif --}}-->





                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit"> <span class="fa fa-send"></span> Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <form class="form form-responsive form-horizontal dropzone" action="{{route('product-images-update', $product_info->id)}}" enctype="multipart/form-data" method="post">
        <input type="hidden" name="_method" value="PUT">
        {{csrf_field()}}
    </form>
    <div class="form-group">
    <button class="btn btn-success" id="uploadImage" type="button"> <span class="fa fa-send"></span> Save Images</button>
</div>
    <div class="ibox">
        <div class="ibox-body">
            <div class="row" id="updated_image_list">
                @include('admin.product.replace-image')
            </div>
        </div>
    </div>

</div>

@endsection
@section('scripts')

<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script src="{{asset('/assets/admin/js/dropzone.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('/assets/admin/js/laravel-file-manager-ck-editor.js')}}"></script>
<script src="{{asset('/assets/admin/js/sweetalert.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/admin/js/jquery-ui.js')}}"></script>
<script>
    Ckeditor('highlight', 100);
    Ckeditor('description', 100);
    Ckeditor('summary', 100);

    function showThumbnail(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
        }
        reader.onload = function(e){
            $('#thumbnail').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }



    Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone(".dropzone", {
            autoProcessQueue: false,
            parallelUploads: 10, // Number of files process at a time (default 2)
            success:function(file, response, data){

                if(response.status == true){
                    // DataSuccessInDatabase(response.message);
                    var product_id = "{{$product_info->id}}";
                    $.ajax({
                        url: "{{route('getProductImageByProductId')}}",
                        method:'GET',
                        data: {id: product_id},
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

    $(document).ready(function(){
        $('body').on('click','.delete_image', function(e){
            e.preventDefault();
            var image_id = $(this).data('image_id');
            var path = $(this).data('path');
            // alert(image_id);
            $.ajax({
                url: "{{route('deleteImageById')}}",
                method: "POST",
                data:{
                    id: image_id,
                    path: path,
                    _token: "{{csrf_token()}}"
                },
                success :function (response){
                    if (response.status == false) {
                        FailedResponseFromDatabase(response.message);
                    }
                    if (response.status == true) {
                        $('.image_id'+image_id).fadeOut(2000);
                        DataSuccessInDatabase(response.message);
                    }
                }
            })
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


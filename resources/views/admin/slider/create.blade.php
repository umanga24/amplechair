@extends('layouts.admin')
@section('page_title') {{ ($slider_info) ? "Update" : "Add New"}} slider @endsection
 
@section('content')
 
<div class="page-heading">
    <h1 class="page-title">  slider</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Home</a>
        </li>
        <li class="breadcrumb-item"> {{ ($slider_info) ? "Update" : "Add New "}} slider</li>
    </ol>

</div>
@include('admin.section.notifications')
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">{{ ($slider_info) ? "Update" : "Add New "}} slider</div>
            <div>
                <a class="btn btn-info btn-md" href="{{route('slider.index')}}">All slider List</a>
            </div>
        </div>
    </div>

    @if(@$slider_info == null)
    <form class="form form-responsive form-horizontal" action="{{route('slider.store')}}" enctype= "multipart/form-data" method="post">
    @else
    <form class="form form-responsive form-horizontal" action="{{route('slider.update', $slider_info->id)}}" enctype= "multipart/form-data" method="post">
    <input type="hidden" name="_method" value="PUT">
    @endif
        {{csrf_field()}}
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Slider Information</div>
                            <div class="ibox-tools">
                                {{--
                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                    --}} 
                                 {{--dd($slider_info)--}}
                            </div>
                        </div>
                        <div class="ibox-body">
                            
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 form-group">
                                    <label>Slider Title</label>
                                    <input class="form-control" type="text" value="{{(@$slider_info->title) ? @$slider_info->title : old('title')}}" name="title" placeholder="Slider Title Here">
                                    @if($errors->has('title'))
                                    <div class="error alert-danger">{{$errors->first('title')}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 form-group">
                                    <label>Slider Sub-Title</label>
                                    <textarea name="sub_title" id="sub_title"   rows="5" class="form-control no_resize" placeholder="Slider sub title Here">{{(@$slider_info->sub_title) ? html_entity_decode(@$slider_info->sub_title) : old('sub_title')}}</textarea>
                                     
                                    @if($errors->has('sub_title'))
                                    <div class="error alert-danger">{{$errors->first('sub_title')}}</div>
                                    @endif
                                </div>
                            </div>
                            {{--
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" name="price" id="price" placeholder="Enter Price" value="{{(@$slider_info->price) ? @$slider_info->price : old('price')}}">
                                </div>
                            </div>
                            --}}
                            
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 form-group">
                                    <label>URL</label>
                                    <input class="form-control" type="text" value="{{(@$slider_info->link) ? @$slider_info->link : old('link')}}" name="link" placeholder="Releated URL link here">
                                    @if($errors->has('link'))
                                    <div class="error alert-danger">{{$errors->first('link')}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-3">
                    <div class="ibox">
                        <div class="ibox-body">
                            <div class="form-group">
                                <label> Updoad Banner</label>
                                <label>[ Image size: width:1350px, height:550px ]</label>
                                <input class="form-control" type="file" name="image" id="image" accept="image/*" onchange="showThumbnail(this);">
                                @if($errors->has('image'))
                                    <div class="error alert-danger">{{$errors->first('image')}}</div>
                                @endif
                            </div>
                            @php
                            $thumbnail = asset('assets/admin/images/default.png');
                            @endphp
                            @if(isset($slider_info->image) && !empty($slider_info->image) && file_exists(public_path().'/uploads/slider/'.$slider_info->image))
                                @php
                                $thumbnail = asset('/uploads/slider/'.$slider_info->image);
                                @endphp
                            @endif 
                            <div class="form-group">
                                <div class="m-r-10">
                                    <img src="{{$thumbnail}}" alt="No Image" class=" img img-thumbnail  img-sm rounded" id="thumbnail" >
                                </div>
                            </div>                             
                             
                            
                            <div class="form-group">
                                <label>Status:</label>
                                <select class="form-control" name="status">
                                    <option value="Publish" {{@($slider_info->status == "Publish") ? "selected" :""}}>Publish</option>
                                    <option value="Unpublish" {{@($slider_info->status == "Unpublish") ? "selected" :""}}>Unpublish</option>
                                </select>
                            </div>
                            @if($errors->has('status'))
                            <div class="error alert-danger">{{$errors->first('status')}}</div>
                            @endif
                            
                             
                            <div class="form-group">
                                <button class="btn btn-success" type="submit"> <span class="fa fa-send"></span> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
     
</div>

@endsection
@section('scripts')

 
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript" src="{{asset('/assets/admin/js/laravel-file-manager-ck-editor.js')}}"></script>
 


<script>

function preventAlph(className){
    $(className).keypress(function(event) {
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
}
var class_name = $('#price');
preventAlph(class_name);


    Ckeditor('sub_title', 150);
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
 
@endsection


@extends('layouts.admin')
@section('page_title') {{ ($gallery_info) ? "Update" : "Add New"}} Gallery @endsection
 
@section('content')
 
<div class="page-heading">
    <h1 class="page-title">  Galleries </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Home</a>
        </li>
        <li class="breadcrumb-item"> {{ ($gallery_info) ? "Update" : "Add New "}} Gallery </li>
    </ol>

</div>
@include('admin.section.notifications')
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">{{ ($gallery_info) ? "Update" : "Add New "}} Gallery</div>
            <div>
                <a class="btn btn-info btn-md" href="{{route('gallery.index')}}">All Galleries List</a>
            </div>
        </div>
    </div>

    @if(@$gallery_info == null)
    <form class="form form-responsive form-horizontal" action="{{route('gallery.store')}}" enctype= "multipart/form-data" method="post">
    @else
    <form class="form form-responsive form-horizontal" action="{{route('gallery.update', $gallery_info->id)}}" enctype= "multipart/form-data" method="post">
    <input type="hidden" name="_method" value="PUT">
    @endif
        {{csrf_field()}}
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
                                    <input class="form-control" type="text" value="{{(@$gallery_info->title) ? @$gallery_info->title : old('title')}}" name="title" placeholder="Title Here">
                                    @if($errors->has('title'))
                                    <div class="error alert-danger">{{$errors->first('title')}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="ibox">
                        <div class="ibox-body">
                            SEO Tools
                            <div class="row">
                                <div class="col-lg-12 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for=""><strong>Meta Title</strong></label>
                                        <textarea name="meta_title" id="meta_title" rows="3" class="form-control" placeholder="Meta Title" style="resize:none;" >{{ (@$gallery_info->meta_title) ?  @$gallery_info->meta_title: old('meta_title')}}</textarea>
                                        @if($errors->has('meta_title'))
                                        <div class="error alert-danger">{{$errors->first('meta_title')}}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for=""><strong>Meta Description</strong></label>
                                        <textarea name="meta_description" id="meta_description" rows="3" class="form-control" placeholder="Meta Description here" style="resize:none;">{{ (@$gallery_info->meta_description) ?  @$gallery_info->meta_description: old('meta_description')}}</textarea>
                                        @if($errors->has('meta_description'))
                                        <div class="error alert-danger">{{$errors->first('meta_description')}}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for=""><strong>Keyword</strong></label>
                                        <textarea name="meta_keyword" id="meta_keyword" rows="3" class="form-control" placeholder="Meta Keyword here" style="resize:none;">{{ (@$gallery_info->meta_keyword) ?  @$gallery_info->meta_keyword: old('meta_keyword')}}</textarea>
                                        @if($errors->has('meta_keyword'))
                                        <div class="error alert-danger">{{$errors->first('meta_keyword')}}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for=""><strong>Meta Keyphrase</strong></label>
                                        <textarea name="meta_keyphrase" id="meta_keyphrase" rows="3" class="form-control" placeholder="Meta Keyword here" style="resize:none;">{{ (@$gallery_info->meta_keyphrase) ?  @$gallery_info->meta_keyphrase: old('meta_keyphrase')}}</textarea>
                                        @if($errors->has('meta_keyphrase'))
                                        <div class="error alert-danger">{{$errors->first('meta_keyphrase')}}</div>
                                        @endif
                                    </div>
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
                                <input class="form-control" type="file" name="thumbnail" id="image" accept="image/*" onchange="showThumbnail(this);">
                                @if($errors->has('thumbnail'))
                                    <div class="error alert-danger">{{$errors->first('thumbnail')}}</div>
                                @endif
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
                                    <img src="{{$thumbnail}}" alt="No Image" class=" img img-thumbnail  img-sm rounded" id="thumbnail" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status:</label>
                                <select class="form-control" name="status">
                                    <option value="Publish" {{@($gallery_info->status == "Publish") ? "selected" :""}}>Publish</option>
                                    <option value="Unpublish" {{@($gallery_info->status == "Unpublish") ? "selected" :""}}>Unpublish</option>
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
 
@endsection


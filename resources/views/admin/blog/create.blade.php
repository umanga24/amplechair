@extends('layouts.admin')
@section('page_title') {{ (@$post_info) ? "Update" : "Add"}} Blog @endsection
@section('styles')
    <link href="{{asset('/assets/admin/css/datepicker.css')}}" rel="stylesheet" />
@endsection
@section('content')

<div class="page-heading">
    <h1 class="page-title">  Blog</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Home</a>
        </li>
        <li class="breadcrumb-item"> {{ ($post_info) ? "Update" : "Add"}} Blog</li>
    </ol>

</div>
@include('admin.section.notifications')
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">{{ ($post_info) ? "Update" : "Add"}} Blog</div>
            <div>
                <a class="btn btn-info btn-md" href="{{route('post.index')}}">All Post</a>
            </div>
        </div>

       <!--  <div class="ibox-body">


        </div> -->
    </div>

{{--dd($post_info)--}}
    @if(@$post_info == null)
    <form class="form form-responsive form-horizontal" action="{{route('post.store')}}" enctype= "multipart/form-data" method="post">
    @else
    <form class="form form-responsive form-horizontal" action="{{route('post.update', $post_info->id)}}" enctype= "multipart/form-data" method="post">
    <input type="hidden" name="_method" value="PUT">
    @endif
    {{csrf_field()}}
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Blog Information</div>
                        </div>
                        <div class="ibox-body">

                            <div class="row">
                                <div class="col-lg-12 col-sm-12 form-group">
                                    <label><strong>Published Date</strong></label>

                                    <input class="form-control" type="text" value="{{ (@$post_info->published_date) ?  @$post_info->published_date: old('published_date')}}" name="published_date" id="published_date" placeholder="Published Date here (Click Calendar on right to pick date)">



                                    @if($errors->has('published_date'))
                                    <div class="error alert-danger">{{$errors->first('published_date')}}</div>
                                    @endif
                                </div>

                                <div class="col-lg-12 col-sm-12 form-group">
                                    <label><strong>Blog Title</strong></label>
                                    <input class="form-control" type="text" value="{{ (@$post_info->title) ?  @$post_info->title: old('title')}}" name="title" placeholder="Blog Title Here">

                                    @if($errors->has('title'))
                                    <div class="error alert-danger">{{$errors->first('title')}}</div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-sm-12 form-group">
                                        <label><h5><strong>Page Url</strong></h5></label> <br>
                                        <input class="form-control" type="text" value="{{ (@$post_info->slug) ?  @$post_info->slug: old('slug')}}" name="slug" id="create_url" placeholder="page url Here">

                                        <div class="message_for_slug display_none"></div>
                                        <div class="message_for_slug_error display_none"></div>
                                        <div class="error">
                                            <p>
                                                <i class="fa fa-angle-double-right" style="padding-right: 5px;"></i> While editing url insert alphpbetical keys or dash ('-') key only.
                                            </p>
                                            <p>
                                                <i class="fa fa-angle-double-right" style="padding-right: 5px;"></i>
                                                Changing url may affect to the website url.
                                            </p>
                                        </div>
                                        <div id="updated_url"  style="padding: 20px 10px;border:1px solid black;margin:15px 0 ;">
                                            {{route('homepage')}}/{{@$post_info->slug}}
                                        </div>

                                        @if($errors->has('slug'))
                                        <div class="error alert-danger">{{$errors->first('slug')}}</div>
                                        @endif
                                    </div>


                                <div class="col-lg-12 col-sm-12 form-group">
                                    <label><strong>Summary</strong></label>
                                    <textarea name="summary" id="summary"   rows="5" placeholder="Summary Here" class="form-control" style="resize: none;">{{ (@$post_info->summary) ?  @$post_info->summary: old('summary')}}</textarea>
                                    @if($errors->has('summary'))
                                    <div class="error alert-danger">{{$errors->first('summary')}}</div>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-sm-12 form-group">
                                    <label><strong>   Writer</strong></label>
                                    <input class="form-control" type="text" value="{{ (@$post_info->writer) ?  @$post_info->writer: old('writer')}}" name="writer" placeholder="Writer Name">

                                    @if($errors->has('writer'))
                                    <div class="error alert-danger">{{$errors->first('writer')}}</div>
                                    @endif
                                </div>

                                <div class="col-lg-12 col-sm-12 form-group">
                                    <label><strong>Description</strong></label>
                                    <textarea name="description" id="description"   rows="5" placeholder="description Here" class="form-control" style="resize: none;">{{ (@$post_info->description) ?  @html_entity_decode($post_info->description): old('description')}}</textarea>
                                    @if($errors->has('description'))
                                    <div class="error alert-danger">{{$errors->first('description')}}</div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-body">
                            SEO Tools
                            <div class="row">
                                <div class="col-lg-12 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for=""><strong>Meta Title</strong></label>
                                        <textarea name="meta_title" id="meta_title" rows="3" class="form-control" placeholder="Meta Title" style="resize:none;" >{{ (@$post_info->meta_title) ?  @$post_info->meta_title: old('meta_title')}}</textarea>
                                        @if($errors->has('meta_title'))
                                        <div class="error alert-danger">{{$errors->first('meta_title')}}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for=""><strong>Meta Description</strong></label>
                                        <textarea name="meta_description" id="meta_description" rows="3" class="form-control" placeholder="Meta Description here" style="resize:none;">{{ (@$post_info->meta_description) ?  @$post_info->meta_description: old('meta_description')}}</textarea>
                                        @if($errors->has('meta_description'))
                                        <div class="error alert-danger">{{$errors->first('meta_description')}}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for=""><strong>Keyword</strong></label>
                                        <textarea name="meta_keyword" id="meta_keyword" rows="3" class="form-control" placeholder="Meta Keyword here" style="resize:none;">{{ (@$post_info->meta_keyword) ?  @$post_info->meta_keyword: old('meta_keyword')}}</textarea>
                                        @if($errors->has('meta_keyword'))
                                        <div class="error alert-danger">{{$errors->first('meta_keyword')}}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for=""><strong>Meta Keyphrase</strong></label>
                                        <textarea name="meta_keyphrase" id="meta_keyphrase" rows="3" class="form-control" placeholder="Meta Keyword here" style="resize:none;">{{ (@$post_info->meta_keyphrase) ?  @$post_info->meta_keyphrase: old('meta_keyphrase')}}</textarea>
                                        @if($errors->has('meta_keyphrase'))
                                        <div class="error alert-danger">{{$errors->first('meta_keyphrase')}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            @if(isset($post_info->thumbnail) && !empty($post_info->thumbnail) && file_exists(public_path().'/uploads/blog/'.$post_info->thumbnail))
                                @php
                                $thumbnail = asset('/uploads/blog/'.$post_info->thumbnail);
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
                                    <option value="Publish" {{@($post_info->status == "Publish") ? "selected" :""}}>Publish</option>
                                    <option value="Unpublish" {{@($post_info->status == "Unpublish") ? "selected" :""}}>Unpublish</option>
                                </select>
                            </div>
                            @if($errors->has('status'))
                            <span class=" alert-danger">{{$errors->first('status')}}</span>
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


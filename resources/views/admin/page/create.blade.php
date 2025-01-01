@extends('layouts.admin')
@section('page_title') {{ ($page_info) ? "Update" : "Add"}} Page @endsection
 
@section('content')
 
<div class="page-heading">
    <h1 class="page-title text-capitalize"> {{@$page_info->title}}</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Home</a>
        </li>
        <li class="breadcrumb-item"> {{ ($page_info) ? "Update" : "Add"}} Page Info</li>
    </ol>

</div>
@include('admin.section.notifications')
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">{{ ($page_info) ? "Update" : "Add"}} Page Info</div>
            <div>
                <a class="btn btn-info btn-md" href="{{route('pageCategory', @$slug)}}">All Page list</a>
            </div>
        </div>
    </div>

    @if($page_info != null)
    <form class="form form-responsive form-horizontal" action="{{route('udpate-page', [@$slug, ($page_info == null) ? '' :@$page_info->id])}}" enctype= "multipart/form-data" method="post">
    @else
    <form class="form form-responsive form-horizontal" action="{{route('create-page', $slug)}}" enctype= "multipart/form-data" method="post">
    @endif
        {{csrf_field()}}
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-12">
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 form-group">
                                        <label><h5><strong>Page group</strong></h5></label>
                                        <select name="page_type" id="page_type" class="form-control">
                                            <option selected disabled>--Select Any One</option>
                                            <option value="article" {{(@$page_info->page_type == 'article') ? 'selected' : ''}}>Article</option>
                                            
                                            <option value="non-article" {{(@$page_info->page_type == 'non-article') ? 'selected' : ''}}>Non Article</option>
                                           
                                            <option value="legal" {{(@$page_info->page_type == 'legal') ? 'selected' : ''}}>Legal</option>
                                        </select>
                                        @if($errors->has('page_type'))
                                        <div class="error alert-danger">
                                            {{$errors->first('page_type')}}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 col-sm-12 form-group">
                                        <label><h5><strong>Page Title*</strong></h5></label>
                                        <input class="form-control" type="text" value="{{ (@$page_info->title) ?  @$page_info->title: old('title')}}" name="title" placeholder="Page title Here">

                                        @if($errors->has('title'))
                                        <div class="error alert-danger">{{$errors->first('title')}}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-8 col-sm-12 form-group">
                                        <label><h5><strong>Page Name* <small>[This will be displayed on the menu]</small></strong></h5></label>
                                        <input class="form-control" type="text" value="{{ (@$page_info->name) ?  @$page_info->name: old('name')}}" name="name" placeholder="Page Name Here">

                                        @if($errors->has('name'))
                                        <div class="error alert-danger">{{$errors->first('name')}}</div>
                                        @endif
                                    </div>
                                    {{--
                                    <div class="col-lg-4 col-sm-12 form-group">
                                        <label><h5><strong>Writer</strong></h5></label>
                                        <input class="form-control" type="text" value="{{ (@$page_info->writer) ?  @$page_info->writer: old('writer')}}" name="writer" placeholder="Author Name">

                                        @if($errors->has('writer'))
                                        <div class="error alert-danger">{{$errors->first('writer')}}</div>
                                        @endif
                                    </div>
                                    --}}
                                    <div class="col-lg-6 col-sm- form-group">
                                        <label for="is_summary">Need summary ? </label>
                                        <select name="is_summary" id="is_summary" class="form-control">
                                            <option  disabled selected >--Select Anyone--</option>
                                            <option value="yes" {{(@$page_info->is_summary =='yes') ? 'selected' : ''}}>Yes</option>
                                            <option value="no" {{(@$page_info->is_summary =='no') ? 'selected' : ''}}>No</option>
                                        </select>
                                        @if($errors->has('is_summary'))
                                        <div class="error alert-danger">{{$errors->first('is_summary')}}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-sm- form-group">
                                        <label for="is_article">Need Blog Area ? </label>
                                        <select name="is_article" id="is_article" class="form-control">
                                            <option disabled selected >--Select Any One--</option>
                                            <option value="yes"{{(@$page_info->is_article =='yes') ? 'selected' : ''}}>Yes</option>
                                            <option value="no" {{(@$page_info->is_article =='no') ? 'selected' : ''}}>No</option>
                                        </select>
                                        @if($errors->has('is_article'))
                                        <div class="error alert-danger">{{$errors->first('is_article')}}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-sm- form-group">
                                        <label for="show_header">Show in Top Menu ? </label>
                                        <select name="show_header" id="show_header" class="form-control">
                                            <option disabled selected >--Select Any One--</option>
                                            <option value="yes"{{(@$page_info->show_header =='yes') ? 'selected' : ''}}>Yes</option>
                                            <option value="no" {{(@$page_info->show_header =='no') ? 'selected' : ''}}>No</option>
                                        </select>
                                        @if($errors->has('show_header'))
                                        <div class="error alert-danger">{{$errors->first('show_header')}}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-sm- form-group">
                                        <label for="show_footer">Show in Bottom Menu ? </label>
                                        <select name="show_footer" id="show_footer" class="form-control">
                                            <option disabled selected >--Select Any One--</option>
                                            <option value="yes"{{(@$page_info->show_footer =='yes') ? 'selected' : ''}}>Yes</option>
                                            <option value="no" {{(@$page_info->show_footer =='no') ? 'selected' : ''}}>No</option>
                                        </select>
                                        @if($errors->has('show_footer'))
                                        <div class="error alert-danger">{{$errors->first('show_footer')}}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 col-sm-12 form-group">
                                        <label><h5><strong>Page Url</strong></h5></label> <br>
                                        <input class="form-control" type="text" value="{{ (@$page_info->slug) ?  @$page_info->slug: old('slug')}}" name="slug" id="create_url" placeholder="page url Here">

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
                                            {{route('homepage')}}/{{@$page_info->slug}}
                                        </div>

                                        @if($errors->has('slug'))
                                        <div class="error alert-danger">{{$errors->first('slug')}}</div>
                                        @endif
                                    </div>
                                   
                                    
                                    <div class="col-lg-12 col-sm-12 form-group hide_summary d-none">
                                        <label><strong>Page Summary</strong></label>
                                        <textarea name="summary" id="summary" rows="5" class="form-control resize_none"  placeholder="Page summary Here">{{ (@$page_info->summary) ?  @html_entity_decode($page_info->summary): old('summary')}}</textarea>
                                    

                                        @if($errors->has('summary'))
                                        <div class="error alert-danger">{{$errors->first('summary')}}</div>
                                        @endif
                                    </div>
                                    
                                    
                                    <div class="col-lg-12 col-sm-12 form-group hide_description d-none">
                                        <label>
                                            <strong>Description</strong>
                                        </label>
                                        <textarea name="description" id="description"  rows="5" class="form-control">{{ (@$page_info->description) ?  @html_entity_decode($page_info->description): old('description')}}</textarea>
                                        @if($errors->has('description'))
                                        <div class="error alert-danger">{{$errors->first('description')}}</div>
                                        @endif
                                    </div>
                                   
                                    
                                   
                                
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-6 col-12">
                                    <strong style="font-size: 18px; margin-top: 15px; margin-bottom: 15px;"> SEO Tools</strong>
                                        <div class="form-group">
                                            <label for=""><strong>Meta Title</strong></label>
                                            <textarea name="meta_title" id="meta_title" rows="3" class="form-control" placeholder="Meta Title" style="resize:none;" >{{ (@$page_info->meta_title) ?  @$page_info->meta_title: old('meta_title')}}</textarea>
                                            @if($errors->has('meta_title'))
                                            <div class="error alert-danger">{{$errors->first('meta_title')}}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for=""><strong>Meta Description</strong></label>
                                            <textarea name="meta_description" id="meta_description" rows="3" class="form-control" placeholder="Meta Description here" style="resize:none;">{{ (@$page_info->meta_description) ?  @$page_info->meta_description: old('meta_description')}}</textarea>
                                            @if($errors->has('meta_description'))
                                            <div class="error alert-danger">{{$errors->first('meta_description')}}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for=""><strong>Keyword</strong></label>
                                            <textarea name="meta_keyword" id="meta_keyword" rows="3" class="form-control" placeholder="Meta keyword here" style="resize:none;">{{ (@$page_info->meta_keyword) ?  @$page_info->meta_keyword: old('meta_keyword')}}</textarea>
                                            @if($errors->has('meta_keyword'))
                                            <div class="error alert-danger">{{$errors->first('meta_keyword')}}</div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for=""><strong>Meta Keyphrase </strong></label>
                                            <textarea name="meta_keyphrase" id="meta_keyphrase" rows="3" class="form-control" placeholder="Meta keyphrase here" style="resize:none;">{{ (@$page_info->meta_keyphrase) ?  @$page_info->meta_keyphrase: old('meta_keyphrase')}}</textarea>
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
                                    <input class="form-control" type="file" name="image" id="image" accept="image/*" onchange="showThumbnail(this);">
                                    @if($errors->has('image'))
                                        <div class="error alert-danger">{{$errors->first('image')}}</div>
                                    @endif
                                </div>
                                @php
                                $thumbnail = asset('assets/admin/images/default.png');
                                @endphp
                                @if(isset($page_info->thumbnail) && !empty($page_info->thumbnail) && file_exists(public_path().'/uploads/Page/'.$page_info->thumbnail))
                                    @php
                                    $thumbnail = asset('/uploads/Page/'.$page_info->thumbnail);
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
                                        <option value="Publish" {{@($page_info->status == "Publish") ? "selected" :""}}>Publish</option>
                                        <option value="Unpublish" {{@($page_info->status == "Unpublish") ? "selected" :""}}>Unpublish</option>
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
<script src="{{asset('/assets/admin/js/sweetalert.js')}}" type="text/javascript"></script>

<script type="text/javascript" src="{{asset('/assets/admin/js/laravel-file-manager-ck-editor.js')}}"></script>
@if(@$page_info->is_summary == 'yes')
<script>
    Ckeditor('summary', 250);
    $(document).ready(function(){
        $('.hide_summary').removeClass('d-none');
    })
</script>
@endif
@if(@$page_info->is_article == 'yes')
<script>
    Ckeditor('description', 250);
    $(document).ready(function(){
        $('.hide_description').removeClass('d-none');
    })
</script>
@endif
<script>

    function preventAlph(className){
        $('#quantity').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != 1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
    }
    preventAlph();


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
                        url: "{{route('checkSlug')}}",
                        data:{
                            slug:slug,
                            _token:"{{csrf_token()}}",
                            id: "{{@$page_info->id}}",
                        }, 
                        success:function(response){
                            if (response.status == true) {
                                url = url+'/'+response.slug;
                                $('.message_for_slug_error').addClass('display_none');
                                $('.message_for_slug').removeClass('display_none').html('<p> <i class="fa fa-check"></i> '+response.message+'</p>');
                                $('#updated_url').html(url);
                            }
                            if (response.status == false) {
                                $('.message_for_slug').addClass('display_none');
                                $('.message_for_slug_error').removeClass('display_none').html('<p> <i class="fa fa-times"></i> '+response.message+'</p>');
                                $('#updated_url').html(url+'/'+"{{@$page_info->slug}}");
                                $('#create_url').val("{{@$page_info->slug}}");
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


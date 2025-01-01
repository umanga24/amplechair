@extends('layouts.admin')
@section('page_title') {{ ($category_info) ? "Update" : "Add New"}} Category @endsection

@section('content')

<div class="page-heading">
    <h1 class="page-title">  Category</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Home</a>
        </li>
        <li class="breadcrumb-item"> {{ ($category_info) ? "Update" : "Add New "}} Category</li>
    </ol>

</div>
@include('admin.section.notifications')
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">{{ ($category_info) ? "Update" : "Add New "}} Category</div>
            <div>
                <a class="btn btn-info btn-md" href="{{route('category.index')}}">All Category List</a>
            </div>
        </div>

       <!--  <div class="ibox-body">


        </div> -->
    </div>

    @if(@$category_info == null)
    <form class="form form-responsive form-horizontal" action="{{route('category.store')}}" enctype= "multipart/form-data" method="post">
    @else
    <form class="form form-responsive form-horizontal" action="{{route('category.update', $category_info->id)}}" enctype= "multipart/form-data" method="post">
    <input type="hidden" name="_method" value="PUT">
    @endif
        {{csrf_field()}}
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Category Information</div>
                            <div class="ibox-tools">
                                {{--
                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                    --}}
                             
                            </div>
                        </div>
                        <div class="ibox-body">

                            <div class="row">
                                <div class="col-lg-12 col-sm-12 form-group">
                                    <label>Category Title</label>
                                    <input class="form-control" type="text" value="{{@$category_info->title}}" name="title" placeholder="Category Title Here">
                                    @if($errors->has('title'))
                                    <span class=" alert-danger">{{$errors->first('title')}}</span>
                                    @endif
                                </div>
                            </div>
                            <!--{{-- <div class="row form-group">-->
                            <!--    <label for="" class="col-sm-3">Is Featured Category ? :</label>-->
                            <!--    <div class="col-sm-1">-->
                            <!--        <label class="ui-checkbox ui-checkbox-warning">-->
                            <!--            <input type="checkbox" name="is_featured"  value="yes" id="is_featured" {{@($category_info->is_featured == 'yes') ? "checked": "unchecked"}} >-->
                            <!--            <span class="input-span"></span>Yes-->
                            <!--        </label>-->
                            <!--    </div>-->
                            <!--    <label class="col-lg-8">-->
                            <!--        <span class="alert-warning">-->
                            <!--            *Remembar: This will allow to display in 'Special Discount Section in homepage.'-->
                            <!--        </span>-->
                            <!--    </label>-->
                            <!--</div> --}}-->


                            <div class="row form-group">
                                <label for="" class="col-sm-3">Show In Top Menu:</label>
                                <div class="col-sm-1">
                                    <label class="ui-checkbox ui-checkbox-warning">
                                        <input type="checkbox" name="show_in_menu"  value="1" id="show_in_menu" {{@($category_info->show_in_menu == 0) ? "unchecked": "checked"}} >
                                        <span class="input-span"></span>Yes
                                    </label>
                                </div>
                                <label class="col-lg-8"><span class="alert-warning">*Remembar:Don't tick on this menu if  this is not a Top Menu Category.</span></label>
                            </div>
                            <!--{{---->
                            <!--<div class="row form-group">-->
                            <!--    <label for="" class="col-sm-3">Show as Banner category:</label>-->
                            <!--    <div class="col-sm-1">-->
                            <!--        <label class="ui-checkbox ui-checkbox-warning">-->
                            <!--            <input type="hidden" name="banner_category"  value="1" id="banner_category" {{@($category_info->banner_category == 'no') ? "unchecked": "checked"}} >-->
                            <!--            <span class="input-span"></span>Yes-->
                            <!--        </label>-->
                            <!--    </div>-->
                            <!--    <label class="col-lg-8">-->
                            <!--        <span class="alert-warning">-->
                            <!--            *Remembar: Accepting this is the category will display after slider in homepage.'-->
                            <!--        </span>-->
                            <!--    </label>-->

                            <!--</div>-->
                            <!----}}-->




                            <div class="row form-group">
                                <label for="" class="col-sm-3">Is Parent:</label>
                                <div class="col-sm-9">
                                    <label class="ui-checkbox ui-checkbox-warning">
                                        <input type="checkbox" name="is_parent"  value="0" id="is_parent" {{@($category_info->is_parent == 0) ? "unchecked": "checked"}} >
                                        <span class="input-span"></span>Yes
                                    </label>

                                </div>
                            </div>

                            <!--<div class="row form-group hidden" id="parent_category_division">-->
                            <!--    <label  class="col-sm-3">Parent Categories:</label>-->
                            <!--    <div class="col-sm-9">-->
                            <!--        <select name="parent_id" id="parent_id" class="form-control">-->
                            <!--            <option disabled selected>--Select Main Category--</option>-->
                            <!--            @if($parents_cat)-->
                            <!--            @foreach($parents_cat as $key => $all_parents)-->
                            <!--            @if((@$category_info->id != $all_parents->id) && ($all_parents->is_parent == 1))-->
                            <!--            <option value="{{$all_parents->id}}" {{@($all_parents->id == $category_info->parent_id)? 'selected' : ''}}>{{ $all_parents->title}}</option>-->
                            <!--            @endif-->
                            <!--            @endforeach-->
                            <!--            @endif-->
                            <!--        </select>-->
                            <!--    </div>-->
                            <!--</div>-->


                            <div class="row form-group">
                                <label  class="col-sm-3">Summary:</label>
                                <div class="col-sm-9">
                                    <textarea name="summary"  rows="5" class="form-control" placeholder="Category Summary">{{ (@$category_info->summary) ?  @$category_info->summary: old('summary')}}</textarea>
                                    @if($errors->has('summary'))
                                        <div class="error alert-danger">{{$errors->first('summary')}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <label  class="col-sm-3">Description:</label>
                                <div class="col-sm-9">
                                    <textarea name="description"  rows="5" class="form-control" placeholder="Category description">{!!(@$category_info->description) ? @html_entity_decode ( @$category_info->description): old('description')!!}</textarea>
                                    @if($errors->has('description'))
                                        <div class="error alert-danger">{{$errors->first('description')}}</div>
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
                                <label> Thumbnail Image</label>
                                <input class="form-control" type="file" name="image" id="image" accept="image/*" onchange="showThumbnail(this);">
                                @if($errors->has('image'))
                                    <div class="error alert-danger">{{$errors->first('image')}}</div>
                                @endif
                            </div>
                            @php
                            $thumbnail = asset('assets/admin/images/default.png');
                            @endphp
                            @if(isset($category_info->image) && !empty($category_info->image) && file_exists(public_path().'/uploads/category/banner/'.$category_info->image))
                                @php
                                $thumbnail = asset('/uploads/category/banner/'.$category_info->image);
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
                                    <option value="Publish" {{@($category_info->status == "Publish") ? "selected" :""}}>Publish</option>
                                    <option value="Unpublish" {{@($category_info->status == "Unpublish") ? "selected" :""}}>Unpublish</option>
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
                    
                    
                     <div class="ibox">
                        <div class="ibox-body">
                            <div class="form-group">
                                <label> Updoad Banner</label>
                                <input class="form-control" type="file" name="image1" id="image1" accept="image/*" onchange="showThumbnail(this);">
                                @if($errors->has('image1'))
                                    <div class="error alert-danger">{{$errors->first('image1')}}</div>
                                @endif
                            </div>
                            @php
                            $thumbnail = asset('assets/admin/images/default.png');
                            @endphp
                            @if(isset($category_info->image1) && !empty($category_info->image1) && file_exists(public_path().'/uploads/category/banner/'.$category_info->image1))
                                @php
                                $thumbnail = asset('/uploads/category/banner/'.$category_info->image1);
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
                                    <option value="Publish" {{@($category_info->status == "Publish") ? "selected" :""}}>Publish</option>
                                    <option value="Unpublish" {{@($category_info->status == "Unpublish") ? "selected" :""}}>Unpublish</option>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('#is_parent').click(function(){
            var checked = $(this).prop('checked');
            if (checked) {
                $('#parent_category_division').addClass('hidden');
                // $("#parent_id").select2();
            } else {
                $('#parent_category_division').removeClass('hidden');
            }
        })
        $('#show_in_menu').click(function(){
            // alert('hello');
            var show = $(this).prop('checked');
            if (show) {
                $('#order_listing').removeClass('hidden');
            }else {
                $('#order_listing').addClass('hidden');
                $('#show_order').val('');
            }
        })
    })
</script>
<!--<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>-->
<!--<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>-->
<script src="//cdn.ckeditor.com/4.9.1/full/ckeditor.js"></script>
<script type="text/javascript" src="{{asset('/assets/admin/js/laravel-file-manager-ck-editor.js')}}"></script>

<script type="text/javascript" src="{{asset('/assets/admin/js/laravel-file-manager-ck-editor.js')}}"></script>
 @if(isset($category_info->is_parent) && $category_info->is_parent == 0)
    <script>
        $('#parent_category_division').removeClass('hidden');
        $('#is_parent').prop('checked', false);
    </script>

@else
    <script>
        $('#parent_category_division').addClass('hidden');
        $('#is_parent').prop('checked', true);
    </script>
@endif

 


<script>

 Ckeditor('description', 250);

    $(document).ready(function() {
        $('#published_date').datepicker({theme:'green', outputFormat: 'y-MM-dd'});
        $('#published_date').keypress(function(event){
            event.preventDefault();
        })
    });
    
    // Ckeditor('description,
    // 250);
    // function showThumbnail(input){
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();
    //     }
    //     reader.onload = function(e){
    //         $('#thumbnail').attr('src', e.target.result);
    //     }
    //     reader.readAsDataURL(input.files[0]);
    // }


</script>

@endsection


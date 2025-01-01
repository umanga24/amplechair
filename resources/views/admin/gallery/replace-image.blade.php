@if(isset($images) && $images->count())
@foreach($images as $image_list)

<div class="col-lg-3 col-md-4 col-6 m_b30 image_id{{$image_list->id}}"">
    <div class=" image_cover">
        <i class="fa fa-times delete_image" data-image_id="{{$image_list->id}}"></i>
        <img src="{{asset('/uploads/gallery/'.$gallery_info->path.'/images/'.$image_list->thumbnail)}}" alt="">
    </div>
 

</div>
@endforeach
@endif
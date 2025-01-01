@if(isset($product_info->other_image) && $product_info->other_image->count())
@foreach($product_info->other_image as $image_list)
 

<div class="col-lg-3 col-md-4 col-6 m_b30 image_id{{$image_list->id}}">
    <div class=" image_cover">
        <i class="fa fa-times delete_image" data-image_id="{{$image_list->id}}" data-path="{{$product_info->path}}"></i>
        <img src="{{asset('/uploads/product/'.$product_info->path.'/product-images/'.$image_list->images)}}" alt="">
    </div>
 

</div>
@endforeach
@endif
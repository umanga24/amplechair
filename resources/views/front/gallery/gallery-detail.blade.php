@extends('layouts.front')
@section('page_title') {{@$gallery_info->title}}  @endsection
@section('meta')
@include('front.include.meta')
@endsection
@section('styles')
 
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/inner.css')}}">
@endsection
@section('content')
<div class="breadcrumbs overlay" data-stellar-background-ratio="0.7" style="background-image: url('{{asset('/uploads/gallery/'.@$gallery_info->path.'/'.@$gallery_info->thumbnail)}}');">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Gallery</a></li>
                </ul>
                <h2>{{ @$gallery_info->title }}</h2>
            </div>
        </div>
    </div>
</div>



 
<section class=" p_tb50 ">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-justify  mission_vission">
				<div class="about">
					<div class="box_block_letter  p_tb50 paragraph">
						<div class="row equal_height">
                            @if(isset($gallery_info))
                            @if(@$gallery_info->ImageList->count())
                            @foreach(@$gallery_info->ImageList as $image_data)
                            
							<div class="col-lg-3 col-md-6 col-12">
								<div class="gallery-view gallery-overlay ">
		                           <img src="{{ asset('/uploads/gallery/'.$gallery_info->path.'/images/'.$image_data->thumbnail)}}" alt="" class="img-fluid">
		                            <div class="gallery-effect gallery-flex-center gallery-rgba">
		                                <a href="{{ asset('/uploads/gallery/'.$gallery_info->path.'/images/'.$image_data->thumbnail)}}" data-lightbox="roadtrip"  ><i class="fa fa-search-plus"></i>
		                                </a>
		                            </div>
		                        </div>
                            </div>
                            @endforeach
                            @endif
                            @endif
							 
						  
						</div>
					</div>						
				</div>
            </div>
            {{--
			<div class="col-lg-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a  href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item active"><a  href="#">1</a></li>
                        <li class="page-item"><a  href="#">2</a></li>
                        <li class="page-item"><a  href="#">3</a></li>
                        <li class="page-item">
                            <a  href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            --}}
		</div>
	</div>
</section>
 
@endsection
@section('scripts')
 
@endsection


 
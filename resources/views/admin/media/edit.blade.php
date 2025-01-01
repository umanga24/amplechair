@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                 <h1>Media</h1>
                    <a href="/video"class="float-end btn btn-info">Back</a>

                </div>

                <div class="card-body">

                    <form action="/video/{{$video->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input id="link" class="form-control" type="text" name="link" placeholder="enter link" value="{{$video->link}}">
                        </div>

                        <div class="form-group">
                            <label for="media_image">Media_image</label>
                            <div class="my-2">
                                <img src="{{asset($video->media_image)}}" height="120" width="120" alt="">
                             </div>
                            <input id="media_image" class="form-control" type="file" name="media_image" placeholder="enter media_image"  value="{{$video->media_image}}">
                        </div>








<!--{{---->
<!--                       <div class="row">-->
<!--                        <div class="col-md-6">-->
<!--                         <div class="form-group">-->
<!--                             <label for="photo">Photo</label>-->
<!--                             <div class="my-2">-->
<!--                                <img src="{{asset($video->photo)}}" alt="">-->
<!--                             </div>-->
<!--                             <input id="photo" class="form-control" type="file" name="photo" placeholder="enter photo"  value="{{$video->photo}}">-->
<!--                         </div>-->
<!--                        </div> --}}-->
<!--{{---->
<!--                        <div class="col-md-6">-->
<!--                         <div class="form-group">-->
<!--                             <label for="banner_image">Banner_image</label>-->
<!--                             <div class="my-2">-->
<!--                                <img src="{{asset($video->banner_image)}}" alt="">-->
<!--                             </div>-->
<!--                             <input id="banner_image" class="form-control" type="file" name="banner_image" placeholder="enter banner_image"  value="{{$video->banner_image}}">-->
<!--                         </div>-->
<!--                        </div> --}}-->
<!--                        </div>-->

                        <button type="submit" class="btn btn-info">Update</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

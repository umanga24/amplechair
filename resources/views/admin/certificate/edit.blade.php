@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Certificate</h1>
                    <a href="/document" class="float-end btn btn-info">Back</a>

                </div>

                <div class="card-body">

                    <form action="/document/{{$document->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                      <div class="form-group">
                        <label for="certificate_title">Certificate_title</label>
                        <input id="certificate_title" class="form-control" type="text" name="certificate_title" placeholder="enter title" value="{{$document->certificate_title}}">
                      </div>


                        <div class="form-group">
                            <label for="short_description">Short_description</label>
                            <textarea id="short_description" class="form-control" name="short_description" rows="3" >{!!$document->short_description!!}</textarea>
                        </div>

                        <!--<div class="form-group">-->
                        <!--    <label for="description">Description</label>-->
                        <!--    <textarea id="description" class="form-control" name="description" rows="3" >{!!$document->description!!}</textarea>-->
                        <!--</div>-->













                       <div class="row">
                        <div class="col-md-6">
                         <div class="form-group">
                             <label for="photo">Image</label>
                             <div class="my-2">
                                <img src="{{asset($document->photo1)}}" alt="">
                             </div>
                             <input id="photo1" class="form-control" type="file" name="photo1" placeholder="enter photo"  value="{{$document->photo1}}">
                         </div>
                        </div>
{{--
                        <div class="col-md-6">
                         <div class="form-group">
                             <label for="banner_image">Banner_image</label>
                             <div class="my-2">
                                <img src="{{asset($document->banner_image)}}" alt="">
                             </div>
                             <input id="banner_image" class="form-control" type="file" name="banner_image" placeholder="enter banner_image"  value="{{$document->banner_image}}">
                         </div>
                        </div> --}}
                        </div>

                        <button type="submit" class="btn btn-info">Update</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

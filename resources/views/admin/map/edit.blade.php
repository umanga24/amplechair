@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Map</h1>
                    <a href="/map" class="float-end btn btn-info">Back</a>

                </div>

                <div class="card-body">

                    <form action="/map/{{$map->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="title">title</label>
                            <input id="title" class="form-control" type="title" name="title" placeholder="enter title" value="{{$map->title}}">
                        </div>


                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" class="form-control" name="description" rows="3">{!!$map->description!!}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Image</label>
                                    <div class="my-2">
                                        <img src="{{asset($map->map_image)}}" alt="">
                                    </div>
                                    <input id="map_image" class="form-control" type="file" name="map_image" placeholder="enter photo" value="{{$map->map}}">
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-info">Update</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
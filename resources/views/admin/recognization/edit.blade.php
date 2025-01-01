@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 >Recogniazation </h1>
                    <a href="/recognization"class="float-end btn btn-info">Back</a>

                </div>

                <div class="card-body">

                    <form action="/recognization/{{$recognization->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input id="link" class="form-control" type="text" name="link" placeholder="enter link" value="{{$recognization->link}}">
                        </div>

                        <div class="form-group">
                            <label for="image2">Image</label>
                            <div class="my-2">
                                <img src="{{asset($recognization->image2)}}" height="120" width="120" alt="">
                             </div>
                            <input id="image2" class="form-control" type="file" name="image2" placeholder="enter image"  value="{{$recognization->image2}}">
                        </div>









                     

                        <button type="submit" class="btn btn-info">Update</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

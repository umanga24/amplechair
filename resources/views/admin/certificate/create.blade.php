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

                    <form action="/document" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="certificate_title">Certificate_Title</label>
                            <input id="certificate_title" class="form-control" type="text" name="certificate_title">
                        </div>
                        <div class="form-group">
                            <label for="short_description">Short_description</label>
                            <textarea id="short_description" class="form-control" name="short_description" rows="3"></textarea>
                        </div>






                       <div class="row">
                        <div class="col-md-6">
                         <div class="form-group">
                             <label for="photo1">Image</label>
                             <input id="photo1" class="form-control" type="file" name="photo1" placeholder="enter image">
                         </div>
                        </div>

                        {{-- <div class="col-md-6">
                         <div class="form-group">
                             <label for="banner_image">Banner_image</label>
                             <input id="banner_image" class="form-control" type="file" name="banner_image" placeholder="enter banner_image">
                         </div>
                        </div> --}}
                        </div>

                        <button type="submit" class="btn btn-info">Submit</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection

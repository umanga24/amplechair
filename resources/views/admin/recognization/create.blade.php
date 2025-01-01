@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 >Recogniazation </h1>
                    <a href="/recognization" class="float-end btn btn-info">Back</a>

                </div>

                <div class="card-body">

                    <form action="/recognization" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input id="link" class="form-control" type="text" name="link" placeholder="enter link">
                        </div>

                        <div class="form-group">
                            <label for="image2">Image</label>
                            <input id="image2" class="form-control" type="file" name="image2" placeholder="enter image">
                        </div>



                        <!--<div class="row">-->
                        <!--<div class="col-md-6">-->
                        <!-- <div class="form-group">-->
                        <!--     <label for="photo">Photo</label>-->
                        <!--     <input id="photo" class="form-control" type="file" name="photo" placeholder="enter photo">-->
                        <!-- </div>-->
                        <!--</div> --}}-->

                        <!--{{-- <div class="col-md-6">-->
                        <!-- <div class="form-group">-->
                        <!--     <label for="banner_image">Banner_image</label>-->
                        <!--     <input id="banner_image" class="form-control" type="file" link="banner_image" placeholder="enter banner_image">-->
                        <!-- </div>-->
                        <!--</div> --}}-->
                        
                        <!--</div>-->

                        <button type="submit" class="btn btn-info">Submit</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection

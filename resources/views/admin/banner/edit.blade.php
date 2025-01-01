@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Banner Images</h1>
                    <!--<span >Banner Images </span>-->
                    <a href="/admin/banner" class="float-end btn btn-info">Back</a>

                </div>

                <div class="card-body">

                    <form action="/admin/banner/{{$banner->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_banner">Client_Banner</label>
                                    <div class="my-2">
                                        <img src="{{asset($banner->client_banner)}}" height="150" width="150" alt="">
                                    </div>
                                    <input id="client_banner" class="form-control" type="file" name="client_banner" accept="image/*" placeholder="enter image">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_banner">Contact_Banner</label>
                                    <div class="my-2">
                                        <img src="{{asset($banner->contact_banner)}}" height="150" width="150" alt="">
                                    </div>
                                    <input id="contact_banner" class="form-control" type="file" name="contact_banner" accept="image/*" placeholder="enter banner_image">
                                </div>
                            </div>
                        </div>


                        <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sustain_banner">Sustain_Banner</label>
                                    <div class="my-2">
                                        <img src="{{asset($banner->sustain_banner)}}" height="150" width="150" alt="">
                                    </div>
                                    <input id="sustain_banner" class="form-control" type="file" name="sustain_banner" accept="image/*" placeholder="enter image">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="media_banner">Media_Banner</label>
                                    <div class="my-2">
                                        <img src="{{asset($banner->media_banner)}}" height="150" width="150" alt="">
                                    </div>
                                    <input id="media_banner" class="form-control" type="file" name="media_banner" accept="image/*" placeholder="enter banner_image">
                                </div>
                            </div>
                        </div> -->

                        <div class="row">
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="certificate_banner">Certificate_Bannner</label>
                                    <div class="my-2">
                                        <img src="{{asset($banner->certificate_banner)}}" height="150" width="150" alt="">
                                    </div>
                                    <input id="certificate_banner" class="form-control" type="file" name="certificate_banner" accept="image/*" placeholder="enter image">
                                </div>
                            </div> -->
                            
                            <!-- 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="team_banner">Team_Banner</label>
                                    <div class="my-2">
                                        <img src="{{asset($banner->team_banner)}}" height="150" width="150" alt="">
                                    </div>
                                    <input id="team_banner" class="form-control" type="file" name="team_banner" accept="image/*" placeholder="enter banner_image">
                                </div>
                            </div> -->
                        </div>

                        <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="process_banner">Procee_Banner</label>
                                    <div class="my-2">
                                        <img src="{{asset($banner->process_banner)}}" height="150" width="150" alt="">
                                    </div>
                                    <input id="process_banner" class="form-control" type="file" name="process_banner" accept="image/*" placeholder="enter image">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="career_banner">Career_Banner</label>
                                    <div class="my-2">
                                        <img src="{{asset($banner->career_banner)}}" height="150" width="150" alt="">
                                    </div>
                                    <input id="career_banner" class="form-control" type="file" name="career_banner" accept="image/*" placeholder="enter banner_image">
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="blog_banner">Blog_banner</label>
                                    <div class="my-2">
                                        <img src="{{asset($banner->blog_banner)}}" height="150" width="150" alt="">
                                    </div>
                                    <input id="blog_banner" class="form-control" type="file" name="blog_banner" accept="image/*" placeholder="enter image">
                                </div>
                            </div>


                        </div> -->
                </div>

                <button type="submit" class="btn btn-info">Update</button>

                </form>


            </div>
        </div>
    </div>
</div>
</div>

@endsection
@extends('layouts.front')
@section('page_title')
@endsection
@section('meta')
{{--
<meta name="description" content="{{@$page_info->meta_description}}"/>

    <meta property="og:locale" content="en_GB" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{@$page_info->meta_title}}" />
    <meta property="og:description" content="{{@$page_info->meta_description}}" />
    <meta property="og:url" content="{{route('homepage')}}" />
    <meta property="og:site_name" content="{{route('homepage')}}" />
    <meta property="og:image" content="{{asset('/uploads/page/'.@$page_info->thumbnail)}}">

    <meta name="twitter:card" content="{{@$page_info->meta_title}}" />
    <meta name="twitter:description" content="{{@$page_info->meta_description}}" />
    <meta name="twitter:title" content="{{@$page_info->meta_title}}" />
    <meta name="twitter:creator" content="{{@$page_info->writer}}"/>
    <meta name="twitter:site" content="{{route('homepage')}}"/>
    <meta name="twitter:image" content="{{asset('/uploads/page/'.@$page_info->thumbnail)}}">

    <meta name="keywords" content="{{@$page_info->meta_keyword}}">
    <meta name="keyphrase" content="{{@$page_info->meta_keyphrase}}"/>

    <meta name="allow-search" content="yes"/>
    <meta name="auther" content="{{@$page_info->writer}}"/>
    <meta name="visit-after" content="30 days"/>
    <meta name="copyright" content="{{date('Y')}} DLY"/>
    <meta name="coverage" content="Worldwide"/>

    <meta name="identifier" content="{{route('homepage')}}"/>
    <meta name="language" content="en"/>
    <link rel="canonical" href="{{route('homepage')}}" />

    <meta name="Robots" content="noodp, noydir, page_info, follow, archive"/>
    <meta name="Googlebot" content="page_info, follow"/>
    <link rel="next" href="{{route('homepage')}}">
    --}}
@endsection
@section('styles')

<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/css/inner.css')}}">

@endsection
@section('content')
@foreach ($banners as $banner)
<div class="breadcrumbs overlay" data-stellar-background-ratio="0.7"
style="background-image: url({{ asset($banner->career_banner) }});">
@endforeach
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!--<ul class="list">-->
                <!--    <li><a href="{{route('homepage')}}">Home</a></li>-->
                <!--    <li><a href="#">Career</a></li>-->
                <!--</ul>-->
                <h2>Career</h2>
            </div>
        </div>
    </div>
</div>

<div class="inner-page-body">

    <div class="career section-padding">
        <div class="container">
                <div class="row">
                    @foreach ($positions as $position)


                    <div class="col-md-4">
                        <div class="career-wrapper">
                            <h4 class="mb-3">{{$position->post_title }} </h4>
                            <button type="button" class="btn-blog" data-toggle="modal" data-target="#exampleModal{{$position->id}}">
                              Learn More
                            </button>

                        </div>
                         <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$position->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$position->id}}" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel{{$position->id}}">{{$position->post_title }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="career-list">
                                                    <li>{!!$position->post_description!!}</li>

                                                </ul>
                                            </div>

                                            <div class="col-md-6">
                                                <form  action="{{url('appeal')}}" enctype="multipart/form-data" method="POST" >
                                                    @csrf
                                                     <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                          <label for="name">Name</label>
                                                          <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                                        </div>

                                                      </div>
                                                      
                                                        <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                          <label for="post">Post</label>
                                                          <input type="post" class="form-control" id="post" name="post"  placeholder="post">
                                                        </div>

                                                      </div>
                                                      
                                                      
                                                      <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                          <label for="eamil">Email</label>
                                                          <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                                        </div>

                                                      </div>
                                                       <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                          <label for="phone">Phone Number</label>
                                                          <input type="phone" class="form-control" id="phone" name="phone" placeholder="phone">
                                                        </div>

                                                      </div>
                                                        <div class="form-group">
                                                            <label for="image">Your Resume</label>
                                                            <input type="file" class="form-control-file" id="image" accept="image/*" name="image">
                                                          </div>

                                                      <button type="submit"  class="btn-blog">Apply Now</button>
                                                    </form>
                                            </div>
                                        </div>
                                      </div>

                                    </div>
                                  </div>
                                </div>
                    </div>
                    @endforeach

                </div>
        </div>
    </div>

</div>
@endsection

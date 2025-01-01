@extends('layouts.admin')
@section('page_title') Website Information Setting @endsection
@section('styles')

<link href="{{asset('/assets/admin/vendors/DataTables/datatables.min.css')}}" rel="stylesheet" />
@endsection
@section('content')

<div class="page-heading">
    <h1 class="page-title"> Website Information</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item"> Update Web Info</li>
    </ol>
    @include('admin.section.notifications')
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">Update Web Info</div>
        </div>
        <div class="ibox-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 m_b30">
                            <div class="ibox height_manage ">
                                <div class="ibox-head">
                                    <div class="ibox-title">Company Address</div>
                                    <div class="ibox-tools">
                                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                    </div>
                                </div>
                                <div class="ibox-body">
                                    <form class="form form-responsive form-horizontal" enctype= "multipart/form-data" method="post" action="{{route('address-update')}}">
                                        {{csrf_field()}}
                                        <div class="row">

                                            <div class="col-lg-12 mb-2 ">
                                                <label>Logo</label>
                                                <input type="file" class="form-control" id="logo" name="logo" value="" placeholder="Logo" onchange="showThumbnail(this);">
                                                @if($errors->has('logo'))
                                                <div class="error alert-danger">{{$errors->first('logo')}}</div>
                                                @endif
                                            </div>

                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                @php
                                                $thumbnail = asset('assets/admin/images/default.png');
                                                @endphp
                                                @if(isset($web_info) && ($web_info !==null))
                                                @if(isset($web_info->logo) && !empty($web_info->logo) && file_exists(public_path().'/uploads/logo/'.$web_info->logo))
                                                    @php
                                                    $thumbnail = asset('/uploads/logo/'.$web_info->logo);
                                                    @endphp
                                                @endif
                                                @endif
                                                <div class="form-group">
                                                    <div class="m-r-10">
                                                        <img src="{{$thumbnail}}" alt="No Image" class=" img img-thumbnail  img-sm rounded" id="thumbnail" >
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="col-lg-12 mb-2 ">
                                                <label>Media</label>
                                                <input type="file" class="form-control" id="logo" name="logo" value="" placeholder="Logo" onchange="showThumbnail(this);">
                                                @if($errors->has('logo'))
                                                <div class="error alert-danger">{{$errors->first('logo')}}</div>
                                                @endif
                                            </div> --}}








                                            <div class="col-lg-12 mb-2 ">
                                                <label>Browser Icon</label>
                                                <input type="file" class="form-control" id="fab_icon" name="fab_icon" value="" placeholder="Logo" onchange="FabIconThumbnail(this);">
                                                @if($errors->has('fab_icon'))
                                                <div class="error alert-danger">{{$errors->first('fab_icon')}}</div>
                                                @endif
                                            </div>

                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                @php
                                                $thumbnail = asset('assets/admin/images/default.png');
                                                @endphp
                                                @if(isset($web_info) && ($web_info !==null))
                                                @if(isset($web_info->fab_icon) && !empty($web_info->fab_icon) && file_exists(public_path().'/uploads/logo/'.$web_info->fab_icon))
                                                    @php
                                                    $thumbnail = asset('/uploads/logo/'.$web_info->fab_icon);
                                                    @endphp
                                                @endif
                                                @endif
                                                <div class="form-group">
                                                    <div class="m-r-10">
                                                        <img src="{{$thumbnail}}" alt="No Image" class=" img img-thumbnail  img-sm rounded" id="fab_icon_thum" >
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-sm-12 form-group">
                                                <label>Company Name</label>
                                                <input class="form-control" type="text" placeholder="Company Name" name="company_name" value="{{@$web_info->company_name}}">
                                                @if($errors->has('company_name'))
                                                <span class=" alert-danger">{{$errors->first('company_name')}}</span>
                                                @endif
                                            </div>
                                            {{--
                                            <div class="col-sm-6 form-group">
                                                <label>Country</label>
                                                <input class="form-control" type="text" placeholder="Country" name="country" value="{{@$web_info->country}}">
                                                @if($errors->has('country'))
                                                <span class=" alert-danger">{{$errors->first('country')}}</span>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 form-group">
                                                <label>District</label>
                                                <input class="form-control" type="text" placeholder="District" name="district" value="{{@$web_info->district}}">
                                                @if($errors->has('district'))
                                                <span class=" alert-danger">{{$errors->first('district')}}</span>
                                                @endif
                                            </div>


                                            <div class="col-sm-6 form-group">
                                                <label>Municipality</label>
                                                <input class="form-control" type="text" placeholder="Municipality" name="municipality" value="{{@$web_info->municipality}}">
                                                @if($errors->has('municipality'))
                                                <span class=" alert-danger">{{$errors->first('municipality')}}</span>
                                                @endif
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label>City</label>
                                                <input class="form-control" type="text" placeholder="City" name="city" value="{{@$web_info->city}}">
                                                @if($errors->has('city'))
                                                <span class=" alert-danger">{{$errors->first('city')}}</span>
                                                @endif
                                            </div>
                                            
                                            <div class="col-sm-6 form-group">
                                                <label>Ward No.</label>
                                                <input class="form-control" type="text" placeholder="Ward No." name="ward_no" value="{{@$web_info->ward_no}}">
                                                @if($errors->has('ward_no'))
                                                <span class=" alert-danger">{{$errors->first('ward_no')}}</span>
                                                @endif
                                            </div>
                                            
                                            

                                            <div class="col-sm-12 form-group">
                                                <label>Working Hours</label>
                                                <input class="form-control" type="text" placeholder="Working Hours" name="work_time" value="{{@$web_info->work_time}}">
                                                @if($errors->has('work_time'))
                                                <span class=" alert-danger">{{$errors->first('work_time')}}</span>
                                                @endif
                                            </div>
                                            --}}
                                            <div class="col-sm-12 form-group">
                                                <label>Location</label>
                                                <textarea name="location" id="location" rows="3" placeholder="Ex: New Baneshwor-25 Shankhamul" class="form-control">{{@$web_info->location}}</textarea>

                                                @if($errors->has('location'))
                                                <span class=" alert-danger">{{$errors->first('location')}}</span>
                                                @endif
                                            </div>
                                            
                                            
                                            <div class="col-sm-12 form-group">
                                                <label>Telephone No</label>
                                                <input class="form-control" type="text" placeholder="Telephone No." name="phone_one" value="{{@$web_info->phone_one}}">
                                                @if($errors->has('phone_one'))
                                                <span class=" alert-danger">{{$errors->first('phone_one')}}</span>
                                                @endif
                                            </div>


                                                <div class="col-sm-12 form-group">
                                                    <label>Facebook</label>
                                                    <input class="form-control" type="text" placeholder="https://www.facebook.com/ " name="facebook_page" value="{{@$web_info->facebook_page}}">
                                                    @if($errors->has('facebook_page'))
                                                    <span class=" alert-danger">{{$errors->first('facebook_page')}}</span>
                                                    @endif
                                                </div>

                                                <div class="col-sm-12 form-group">
                                                    <label>Twitter</label>
                                                    <input class="form-control" type="text" placeholder="https://www.twitter.com/ " name="twitter_id" value="{{@$web_info->twitter_id}}">
                                                    @if($errors->has('twitter_id'))
                                                    <span class=" alert-danger">{{$errors->first('twitter_id')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-12 form-group">
                                                    <label>Instagram</label>
                                                    <input class="form-control" type="text" placeholder="https://www.instagram.com/ " name="insta_id" value="{{@$web_info->insta_id}}">
                                                    @if($errors->has('insta_id'))
                                                    <span class=" alert-danger">{{$errors->first('insta_id')}}</span>
                                                    @endif
                                                </div>




                                            <div class="col-sm-12 form-group">
                                                <label>Mobile No.</label>
                                                <input class="form-control" type="text" placeholder="Mobile No." name="phone_two" value="{{@$web_info->phone_two}}">
                                                @if($errors->has('phone_two'))
                                                <span class=" alert-danger">{{$errors->first('phone_two')}}</span>
                                                @endif
                                            </div>
                                            <div class="col-sm-12 form-group">
                                                <label> Email Address</label>
                                                <input class="form-control" type="text" placeholder="Email Address" name="email" value="{{@$web_info->email}}">
                                                @if($errors->has('email'))
                                                <span class=" alert-danger">{{$errors->first('email')}}</span>
                                                @endif
                                            </div>
                                             <div class="col-sm-12 form-group">
                                                <label> Google Map</label>
                                                <input class="form-control" type="text" placeholder="Enter Map" name="map" value="{{@$web_info->map}}">
                                                @if($errors->has('map'))
                                                <span class=" alert-danger">{{$errors->first('map')}}</span>
                                                @endif
                                            </div>

                                            <!--<div class="col-sm-12 form-group">-->
                                            <!--    <label> Mail Sender Email Address</label>-->
                                            <!--    <input class="form-control" type="text" placeholder="Mail Sender Email Address" name="mail_sender_email" value="{{@$web_info->mail_sender_email}}">-->
                                            <!--    @if($errors->has('mail_sender_email'))-->
                                            <!--    <span class=" alert-danger">{{$errors->first('mail_sender_email')}}</span>-->
                                            <!--    @endif-->
                                            <!--</div>-->



                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 text-right">
                                                <div class="form-group">
                                                    <button class="btn btn-success" type="submit">Update Addresses</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{--
                        <div class="col-lg-6 col-md-6 col-12 m_b30">
                            <div class="ibox height_manage">
                                <div class="ibox-head">
                                    <div class="ibox-title">Social Links</div>
                                    <div class="ibox-tools">
                                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                    </div>
                                </div>

                                <div class="ibox-body">
                                    <form class="form form-responsive form-horizontal" enctype= "multipart/form-data" method="post" action="{{route('address-update')}}">
                                    {{csrf_field()}}
                                        <div class="row">
                                            <div class="col-sm-12 form-group">
                                                <label>Facebook page Link</label>
                                                <input class="form-control" type="text" placeholder="Facebook Page Link" name="facebook_page" value="{{@$web_info->facebook_page}}">
                                                @if($errors->has('facebook_page'))
                                                <span class=" alert-danger">{{$errors->first('facebook_page')}}</span>
                                                @endif
                                            </div>
                                            <div class="col-sm-12 form-group">
                                                <label>Twitter Page Link</label>
                                                <input class="form-control" type="text" placeholder="Twitter Page Link" name="twitter_id" value="{{@$web_info->twitter_id}}">
                                                @if($errors->has('twitter_id'))
                                                <span class=" alert-danger">{{$errors->first('twitter_id')}}</span>
                                                @endif
                                            </div>
                                            <div class="col-sm-12 form-group">
                                                <label>Instagram Page Link</label>
                                                <input class="form-control" type="text" placeholder="Instagram Page Link" name="insta_id" value="{{@$web_info->insta_id}}">
                                                @if($errors->has('insta_id'))
                                                <span class=" alert-danger">{{$errors->first('insta_id')}}</span>
                                                @endif
                                            </div>


                                            <div class="col-sm-12 form-group">
                                                <label>Youtube Channel Link</label>
                                                <input class="form-control" type="text" placeholder="Youtube Channel Link" name="youtube_channel" value="{{@$web_info->youtube_channel}}">
                                                @if($errors->has('youtube_channel'))
                                                <span class=" alert-danger">{{$errors->first('youtube_channel')}}</span>
                                                @endif
                                            </div>

                                            <div class="col-sm-12 form-group">
                                                <label>Tumblr Link</label>
                                                <input class="form-control" type="text" placeholder="Tumblr Link" name="tumblr" value="{{@$web_info->tumblr}}">
                                                @if($errors->has('tumblr'))
                                                <span class=" alert-danger">{{$errors->first('tumblr')}}</span>
                                                @endif
                                            </div>

                                            <div class="col-sm-12 form-group">
                                                <label>Pinterest  Link</label>
                                                <input class="form-control" type="text" placeholder="Pienterest Link" name="pinterest_id" value="{{@$web_info->pinterest_id}}">
                                                @if($errors->has('pinterest_id'))
                                                <span class=" alert-danger">{{$errors->first('pinterest_id')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 text-right">
                                                <div class="form-group">
                                                    <button class="btn btn-success" type="submit">Update Links</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                         --}}
                         {{--

                        <div class="col-lg-12 col-md-12 col-12 m_b30">
                            <div class="ibox height_manage">
                                <div class="ibox-body">
                                    <form class="form form-responsive form-horizontal" enctype= "multipart/form-data" method="post" action="{{route('address-update')}}">
                                    {{csrf_field()}}
                                        <div class="row">

                                            <div class="form-group">
                                                <label class="ui-checkbox">
                                                    <input type="checkbox" value="1"{{@($web_info->go_live== 1) ? 'checked' : 'unchecked'}}  name="go_live" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class="input-span"></span>Go Live</label>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <button class="btn btn-success" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('scripts')

<script src="{{asset('/assets/admin/js/sweetalert.js')}}" type="text/javascript"></script>
@section('scripts')
<script>
    function showThumbnail(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
        }
        reader.onload = function(e){
            $('#thumbnail').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
    function FabIconThumbnail(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
        }
        reader.onload = function(e){
            $('#fab_icon_thum').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }



</script>
@endsection
<script>


function FailedResponseFromDatabase(message){
    html_error = "";
    $.each(message, function(index, message){
        html_error += '<p class ="error_message text-left"> <span class="fa fa-times"></span> '+message+ '</p>';
    });
    Swal.fire({
        type: 'error',
        title: 'Oops...',
        html:html_error ,
        confirmButtonText: 'Close',
        timer: 10000
    });
}
function DataSuccessInDatabase(message){
    Swal.fire({
        // position: 'top-end',
        type: 'success',
        title: 'Done',
        html: message ,
        confirmButtonText: 'Close',
        timer: 10000
    });
}
</script>
@endsection

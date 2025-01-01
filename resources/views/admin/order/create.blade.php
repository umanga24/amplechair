@extends('layouts.admin')
@section('page_title') {{ ($order_info) ? "Update" : "Add New"}} Order @endsection
 
@section('content')
 
<div class="page-heading">
    <h1 class="page-title">  Order</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Home</a>
        </li>
        <li class="breadcrumb-item"> {{ ($order_info) ? "Update" : "Add New "}} Order</li>
    </ol>

</div>
@include('admin.section.notifications')
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            
            <div class="ibox-title">{{ ($order_info) ? "Update" : "Add New "}} Order</div>
             
            <div>
                <a class="btn btn-info btn-md" href="{{route('order-list')}}">All Order List</a>
            </div>
        </div>
    </div>

    @if(@$order_info == null)
    <form class="form form-responsive form-horizontal" action="{{route('order_store')}}" enctype= "multipart/form-data" method="post">
    @else
    <form class="form form-responsive form-horizontal" action="{{route('order_update', $order_info->id)}}" enctype= "multipart/form-data" method="post">
 
    @endif
        {{csrf_field()}}
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Order Information</div>
                            <div class="ibox-tools">
                                {{--
                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                    --}} 
                                {{--dd($order_info)--}}
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 form-group">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product Title</th>
                                                <!--<th>Original Price</th>-->
                                                <!--<th>Discounted Price</th>-->
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{@$order_info->productInfo->title}}</td>
                                               
                                                <!--<td>Rs. {{number_format(@$order_info->price, 2)}}</td>-->
                                                <!--<td>Rs. {{@discount($order_info->price, $order_info->discount)}}</td>-->
                                                 
                                            </tr>
                                        </tbody>
                                    </table>
                                 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4><strong>Shipping Detail</strong></h4>
                                </div>
                                 
                                <div class="col-lg-6 col-sm-12 form-group">
                                    <label>Phone No</label>
                                    <input class="form-control" type="text" value="{{(@$order_info->phone) ? @$order_info->phone : old('phone')}}" name="phone" placeholder="Product phone Here" disabled>
                                    @if($errors->has('phone'))
                                    <span class=" alert-danger">{{$errors->first('phone')}}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-sm-12 form-group">
                                    <label>Order Id</label>
                                    <input class="form-control" type="text" value="{{(@$order_info->order_id) ? @$order_info->order_id : old('order_id')}}" name="order_id" placeholder="Product order_id Here" disabled>
                                    @if($errors->has('order_id'))
                                    <span class=" alert-danger">{{$errors->first('order_id')}}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-sm-12 form-group">
                                    <label>Ordered Quntity </label>
                                    <input class="form-control" type="text" value="{{(@$order_info->quantity) ? @$order_info->quantity : old('quantity')}}" name="quantity" placeholder="Ordered Quantity" disabled>
                                    @if($errors->has('quantity'))
                                    <span class=" alert-danger">{{$errors->first('quantity')}}</span>
                                    @endif
                                </div>
                                 
                                <div class="col-lg-6 col-sm-12 form-group">
                                    <label>location</label>
                                    <textarea name="location" id="location"  rows="3" disabled class="form-control resize_no">{{(@$order_info->location) ? @$order_info->location : old('location')}}</textarea>
                                   
                                    @if($errors->has('location'))
                                    <span class=" alert-danger">{{$errors->first('location')}}</span>
                                    @endif
                                </div>
                                <div class="col-lg-12 col-sm-12 form-group">
                                    <label>Order Note</label>
                                    <textarea name="message" id="message"  rows="3" disabled class="form-control resize_no">{{(@$order_info->message) ? @$order_info->message : old('message')}}</textarea>
                                   
                                    @if($errors->has('message'))
                                    <span class=" alert-danger">{{$errors->first('message')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-3">
                    <div class="ibox">
                        <div class="ibox-body">
                       
                            @php
                            $thumbnail = asset('assets/admin/images/default.png');
                            @endphp
                            @if(isset($order_info->productInfo->image) && !empty($order_info->productInfo->image) && file_exists(public_path().'/uploads/product/'.$order_info->productInfo->path.'/thumbnail/'.$order_info->productInfo->image))
                                @php
                                $thumbnail = asset('/uploads/product/'.$order_info->productInfo->path.'/thumbnail/'.$order_info->productInfo->image);
                                @endphp
                            @endif 
                            <div class="form-group">
                                <div class="m-r-10">
                                    <img src="{{$thumbnail}}" alt="No Image" class=" img img-thumbnail  img-sm rounded" id="thumbnail" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Order Status:</label>
                                <select class="form-control" name="status">
                                    <option value="New" {{@($order_info->status == "New") ? "selected" :""}}>New</option>
                                    <option value="Verified" {{@($order_info->status == "Verified") ? "selected" :""}}>Verified</option>

                                    <option value="Cancel" {{@($order_info->status == "Cancel") ? "selected" :""}}>Cancel</option>

                                    <option value="Process" {{@($order_info->status == "Process") ? "selected" :""}}>Process</option>
                                    <option value="Delivered" {{@($order_info->status == "Delivered") ? "selected" :""}}>Delivered</option>
                                </select>
                            </div>
                        
                            @if($errors->has('status'))
                            <span class=" alert-danger">{{$errors->first('status')}}</span>
                            @endif
                            
                             
                            <div class="form-group">
                                <button class="btn btn-success" type="submit"> <span class="fa fa-send"></span> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
     
</div>

@endsection
@section('scripts')

 
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript" src="{{asset('/assets/admin/js/laravel-file-manager-ck-editor.js')}}"></script>
 


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
    
</script>
 
@endsection


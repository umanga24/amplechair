@extends('layouts.admin')
@section('page_title') All Products @endsection
@section('styles')

<link href="{{asset('/assets/admin/vendors/DataTables/datatables.min.css')}}" rel="stylesheet" />
@endsection
@section('content')

<div class="page-heading">
    <h1 class="page-title"> Products</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item"> All Products</li>
    </ol>
@include('admin.section.notifications')
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">All Products</div>
            <div>
                <a class="btn btn-info btn-md" href="{{route('product.create')}}">New Product</a>
            </div>
        </div>


        <div class="ibox-body">
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr class="border-0">
                        <th>SN</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Categories</th>
                        <!--<th>Images/Detail</th>-->
                        <th>Price</th>
                        <!--<th> Discount</th>-->
                        <th>Status</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if( isset($products))

                    @foreach($products as $key => $product_data)
                        <tr class='clickable-row' data-href="{{route('product.edit', $product_data->id)}}">

                            <td>{{ $key+1}}</td>
                            <td>
                                @if(!empty($product_data->image) && file_exists(public_path().'/uploads/product/'.$product_data->path.'/thumbnail/'.$product_data->image))
                                    <div class="m-r-10">
                                    <a href="{{asset('/uploads/product/thumbmail/'.$product_data->image)}}" target="_adimage">
                                        <img src="{{asset('/uploads/product/'.$product_data->path.'/thumbnail/'.$product_data->image)}}" alt="No Image" class="rounded" width="70">
                                    </a>

                                    </div>
                                @endif
                            </td>
                            <td>{{ $product_data->title}}</td>

                            <td>
                                 {{ $product_data->category_info['title']}} 
                                {{-- {{ $product_data->subcat_info['title']}} --}}
                            </td>

                            <!--<td>-->
                            <!--    <a href="{{route('edit-product', $product_data->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>-->
                            <!--</td>-->

                            <td>${{ number_format($product_data->price)}}</td>
                            <!--{{-- <td> {{ $product_data->discount}} %</td> --}}-->


                            <td>{{ $product_data->status}}ed</td>
                            <td>
                                <ul class="action_list">
                                    <li>
                                        <a href="{{route('product.edit', $product_data->id)}}" data- class="btn btn-info btn-md"><i class="fa fa-edit"></i></a>

                                    </li>

                                    <li>
                                        <form action="{{ route('product.destroy', $product_data->id) }}" method="post">
                                            @csrf()
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure you want to delete this Product?')" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </li>

                            </ul>

                            </td>

                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8">
                            You do not have any Products  yet.
                        </td>
                    </tr>
                    @endif



                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection
@section('scripts')
<script src="{{asset('/assets/admin/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/admin/js/sweetalert.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('#example-table').DataTable({
            pageLength: 25,
        });
    })
</script>
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

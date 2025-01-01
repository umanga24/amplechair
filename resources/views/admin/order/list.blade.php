@extends('layouts.admin')
@section('page_title') All Orders @endsection
@section('styles')
 
<link href="{{asset('/assets/admin/vendors/DataTables/datatables.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
 
<div class="page-heading">
    <h1 class="page-title"> Orders</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item"> All Orders</li>
    </ol>
@include('admin.section.notifications')
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">All Orders</div>
            <div>{{--
                <a href="{{route('category-order')}}" class="btn btn-info btn-md">Ordering</a>
                <a class="btn btn-info btn-md" href="{{route('category.create')}}">New Category</a>
                --}}
            </div>
        </div>
         

        <div class="ibox-body">
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Product Name </th>
                        <th>Customer Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    
                    @if($orders->count())
                    
                    @foreach($orders as $key => $order_data)
                   

                    <tr class="category_row{{$order_data->id}}">
                        <td> {{$key +1}}</td>
                        
                        <td class="text-capitalize"> {{$order_data->productInfo->title}}</td>
                        <td>{{$order_data->name}}</td>
                       
                        
                         
                        
                         
                        
                        <td class="changeStatus{{$order_data->id}}">

    
                            <span class="btn btn-rounded btn-sm {{orderProccess($order_data->status) }}   changeStatus" data-status="{{$order_data->status}}" data-category_id = "{{$order_data->id}}" style="cursor: pointer;">{{$order_data->status}}</span>
                            
                        </td>
                        <td>
                            <ul class="action_list">
                                <li>
                                    <a href="{{route('edit-order', $order_data->id)}}" data- class="btn btn-info btn-md"><i class="fa fa-edit"></i></a>
                                    
                                </li>
                                {{--
                                <li>

                                    <form action="{{ route('category.destroy', $order_data->id) }}" method="post">
                                        @csrf()
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure you want to delete this Category?')" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </li>
                                --}}
                              
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8">
                            You do not have any Product order yet.
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
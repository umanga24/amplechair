@extends('layouts.admin')
@section('page_title') All {{$title}} pages @endsection
@section('styles')
 
<link href="{{asset('/assets/admin/vendors/DataTables/datatables.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
 
<div class="page-heading">
    <h1 class="page-title"> Pages </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item"> All {{$title}} pages</li>
    </ol>
@include('admin.section.notifications')
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">All {{$title}} pages</div>
            <div>
                <button class="btn btn-info btn-md reloadme" data-toggle="tooltip" data-placement="top" title="Refresh Data"><i class="fa fa-refresh"></i></button>
               
                <a class="btn btn-info btn-md" href="{{route('page-ordering', $slug)}}">Ordering</a>
                

                <a class="btn btn-info btn-md" href="{{route('create-page', $slug)}}">New {{$title}} page</a>
            </div>
        </div>
         

        <div class="ibox-body">
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <td>Page Name</td>
                        <th>URL</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @if($pages->count())
                    @foreach($pages as $key => $page_data)
                     
                    <tr class="category_row{{$page_data->id}}">
                        <td> {{$key +1}}</td>
                        <td class="text-capitalize"> {{$page_data->title}}</td>
                        <td>{{route('homepage')}}/{{$page_data->slug}}</td>

                        <td class="changeStatus{{$page_data->id}}">

                            <span class="btn btn-rounded btn-sm {{($page_data->status == 'Publish') ? 'btn-success':   'btn-warning'}}  ChangeStatus" data-status="{{$page_data->status}}" data-data_id = "{{$page_data->id}}" style="cursor: pointer;">{{$page_data->status}}ed</span>
                            
                        </td>
                        <td>
                            <ul class="action_list">
                                <li>
                                    <a href="{{route('edit-page',[$slug, $page_data->id])}}" data- class="btn btn-info btn-md"><i class="fa fa-edit"></i></a>
                                    
                                </li>
                                @if($page_data->keep_alive != 'keep_alive')
                                <li>

                                    <form action="{{ route('slider.destroy', $page_data->id) }}" method="post">
                                        @csrf()
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure you want to delete this Page?')" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </li>
                                @endif
                             
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8">
                            You do not have any page  yet.
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
    $(document).ready(function(){
        $('body').on('click',  '.ChangeStatus', function(e){
            e.preventDefault();
            $.ajax({
                url:"{{route('changePageStatus')}}",
                method:"POST",
                data:{
                    page_id : $(this).data('data_id'),
                    status : $(this).data('status'),
                    _token: "{{csrf_token()}}"
                },
                success : function(response){
                    if (response.status == false ) {
                        FailedResponseFromDatabase(response.message);
                    }
                    if (response.status == true) {
                        DataSuccessInDatabase(response.message);
                        var update_data = response.data[0];
                        var replace_html = '<span class="btn btn-rounded btn-sm btn-'+((update_data.status == 'Publish')? 'success' : 'warning')+' ChangeStatus" data-status="'+update_data.status+'" data-data_id = "'+update_data.id+'" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title= "Make '+((update_data.status == 'Publish')? 'Unpublish' : 'Publish')+' this Slider.">'+update_data.status+'ed</span>';
                        $('.changeStatus'+update_data.id).html(replace_html);
                    }
                }
            })
        })
    })

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
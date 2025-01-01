@extends('layouts.admin')
@section('page_title') All Gallery List @endsection
@section('styles')
 
<link href="{{asset('/assets/admin/vendors/DataTables/datatables.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
 
<div class="page-heading">
    <h1 class="page-title"> All Gallery List </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">All Gallery List</li>
    </ol>
@include('admin.section.notifications')
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">All Gallery List</div>
            <div>
                <button class="btn btn-info btn-md reloadme" data-toggle="tooltip" data-placement="top" title="Refresh Data"><i class="fa fa-refresh"></i></button>
              
                

                <a class="btn btn-info btn-md" href="{{route('gallery.create')}}" data-toggle="tooltip" data-placement="top" title="Add New Gallery">New  Gallery</a>
            </div>
        </div>
         

        <div class="ibox-body">
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Images</th>

                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @if($all_galleries->count())
                    @foreach($all_galleries as $key => $gallery_data)
                     
                    <tr class="category_row{{$gallery_data->id}}">
                        <td> {{$key +1}}</td>
                        <td>
                            @if(!empty($gallery_data->thumbnail) && file_exists(public_path().'/uploads/gallery/'.$gallery_data->path.'/'.$gallery_data->thumbnail))
                                <div class="m-r-10">
                                <a href="{{asset('/uploads/gallery/'.$gallery_data->path.'/'.$gallery_data->thumbnail)}}" target="_adimage">
                                    <img src="{{asset('/uploads/gallery/'.$gallery_data->path.'/'.$gallery_data->thumbnail)}}" alt="No Image" class="rounded" width="70">
                                </a> 
                                </div>
                            @endif
                        </td>
                        
                        <td class="text-capitalize"> {{$gallery_data->title}}</td>
                        <td>
                            <a href="{{route('GalleryImage', $gallery_data->id)}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Add or update gallery Images"><i class="fa fa-image"></i></a>
                        </td>
                    

                        <td class="changeStatus{{$gallery_data->id}}">
                            <span class="btn btn-rounded btn-sm {{($gallery_data->status == 'Publish') ? 'btn-success':   'btn-warning'}}  ChangeStatus" data-status="{{$gallery_data->status}}" data-data_id = "{{$gallery_data->id}}" style="cursor: pointer;">{{$gallery_data->status}}ed</span>
                        </td>
                        <td>
                            <ul class="action_list">
                                <li>
                                    <a href="{{route('gallery.edit', $gallery_data->id)}}" data- class="btn btn-info btn-md" ><i class="fa fa-edit"></i></a>
                                    
                                </li>
                                @if($gallery_data->keep_alive != 'keep_alive')
                                <li>

                                    <form action="{{ route('gallery.destroy', $gallery_data->id) }}" method="post">
                                        @csrf()
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure you want to delete this Gallery ?')" class="btn btn-danger">
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
                            You do not have any Gallery list  yet.
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
                url:"{{route('changeGalleryStatus')}}",
                method:"POST",
                data:{
                    id : $(this).data('data_id'),
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
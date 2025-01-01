@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                     <h1>Media</h1>
                    @if(empty($video))
                    <a href="/video/create" class="float-end btn btn-info">Add</a>
                    @endif

                </div>

                <div class="card-body">
                    <table class="table table-striped" id='example-table'>
                        <thead>
                            <tr>
                                <th>S.N</th>
                               <th>Link</th>
                               <th>Image</th>
                               <th>Status</th>


                               <th>Action</th>

                            </tr>

                        </thead>

                        @if(!empty($videos))
                        @php($i=1)
                        @foreach ($videos as $video)


                        <tbody>

                        <tr>
                            <td>{{$i}}</td>

                            <td>{{$video->link}}</td>
                            <td>  <img src="{{asset($video->media_image)}}" height="120" width="120" alt=""></td>
                           <td>                            
                        <span class="btn btn-rounded btn-sm bg-success text-white">Active</span>
                        </td>

                            <td>

                                <form action="/video/{{$video->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="/video/{{$video->id}}/edit" class="btn btn-info">Edit</a>
                                    <button type="submit" class="btn btn-danger">Delete</button>

                                </form>
                            </td>
                        </tr>





                        </tbody>
                        @php($i++)


                        @endforeach
                        @endif

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{asset('/assets/admin/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('#example-table').DataTable({
            pageLength: 25,
        });
    })
    $(document).ready(function(){
    	$('.Open_message').click(function(){
    		var message = $(this).data('message');
    		$('.message_info').html(message.message);
    		$('.message_link').html(message.link);
    		$('.message_media_image').html(message.media_image);
    		$('.message_phone').html(message.phone);
    		$('.message_email').html(message.email);
    		$('.message_date').html(message.created_at);

    		$('#messege_screen').modal('show');
    	})
    })
</script>
@endsection

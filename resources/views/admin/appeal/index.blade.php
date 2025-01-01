@extends('layouts.admin')
@section('page_title') All Message & Feedback list @endsection
@section('styles')


@endsection
@section('content')

 
<div class="page-heading">
    <h1 class="page-title">Applicants</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item"> Applicants</li>
    </ol>
<!--@include('admin.section.notifications')-->
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">All Applicants List</div>
        </div>
         

        <div class="ibox-body">
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Post</th>
                        <th>Name</th>
                         <th>Email</th>
                        <th>Phone</th>
                        <th>Resume</th>
                       
                        <th>Sent on</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @if($appeals->count())
                    @foreach($appeals as $key => $appeal)
        
                    <tr>
                        <td> {{$key +1}}</td>
                        <td> {{$appeal->post}}</td>
                        <td> {{$appeal->name}}</td>
                        <td> {{$appeal->email}}</td>
                        <td> {{$appeal->phone}}</td>
                        <td>
                            <!--<img src="{{asset($appeal->image)}}" height="150" width="150" alt-->
                            <!--<button id="raju" class="btn btn-info" onclick="window.print()"> <i class="fas fa-print"></i>Print</button>-->
                            <img src="{{ asset($appeal->image) }}" height="150" width="150" alt="Image">
    <br>
    <a href="{{ asset($appeal->image) }}" download="image.jpg" class="btn btn-info">
         Download
    </a>
    <!--<button id="raju" class="btn btn-info" onclick="window.print()">-->
    <!--    <i class="fas fa-print"></i> Print-->
    <!--</button>-->

                        </td>
                        <td> {{$appeal->created_at}}</td>
                        <td>
                            <ul class="action_list">
                                <li>
                                    <button class="btn btn-success btn-lg Open_message" data-message="{{$appeal}}">
                                    	<i class="fa fa-eye" data-title="Open Message"></i>
                                    </button>
                                    
                                </li>
                                
                                <li>
                                    <form action="/appeal/{{ $appeal->id }} " method="post">
                                        @csrf()
                                        @method('DELETE')
                                        <button   onclick="return confirm('Are you sure you want to delete this Message?')" class="btn btn-danger btn-lg">
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
                            You do not have any Message list yet.
                        </td>
                    </tr>
                    @endif
                </tbody>
                 
            </table>
        </div>
    </div>
     
</div>


<div class="modal fade" id="messege_screen" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
	  		<form action="" method="post" enctype="multipart/form-data" id="first-form">
		    	<div class="modal-content jobapplyform">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel">Applicants Details</h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
					<div class="modal-body">
						<div class="row form-group">
							<div class="col-lg-12">
								<p class="message_info"></p>
								<p><strong>Post : </strong><span class="message_post"></span></p>
								<p><strong>Name : </strong><span class="message_name"></span></p>
								<p><strong> Email : </strong><span class="message_email"></span></p>
								<p><strong> Phone : </strong><span class="message_phone"></span></p>
							
								<p><strong>Sent Date : </strong><span class="message_date"></span></p>

							</div>
							 
							 
							 
						</div>
					</div>
					<div class="modal-footer">
						 
					</div>
				</div>
	  		</form>
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
    		$('.message_post').html(message.post);
    		$('.message_name').html(message.name);
    		$('.message_phone').html(message.phone);
    		$('.message_email').html(message.email);
    		$('.message_date').html(message.created_at);

    		$('#messege_screen').modal('show');
    	})
    })
</script>
@endsection
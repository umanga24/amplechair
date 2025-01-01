@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                     <h1>Process</h1>
                    @if(empty($operation))
                    <a href="/operation/create" class="float-end btn btn-info">Add</a>
                    @endif

                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>S.N</th>
                               <th>Title</th>
                               <!--<th>Description</th>-->
                               <th>Image</th>

                               <th>Status</th>


                               <th>Action</th>

                            </tr>

                        </thead>

                        @if(!empty($operations))
                        @php($i=1)
                        @foreach ($operations as $operation)


                        <tbody>

                        <tr>
                            <td>{{$i}}</td>

                            <td>{{$operation->process_title}}</td>
                            <!--<td>{!!$operation->process_description!!}</td>-->
                            <td><img src="{{asset($operation->process_image)}}"  height="120" width="120" alt=""></td>
                            <td>                            
                        <span class="btn btn-rounded btn-sm bg-success text-white">Active</span>
                        </td>

                            <td>

                                <form action="/operation/{{$operation->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="/operation/{{$operation->id}}/edit" class="btn btn-info">Edit</a>
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

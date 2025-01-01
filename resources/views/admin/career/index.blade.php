@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Career</h1>
                    @if(empty($position))
                    <a href="/position/create" class="float-end btn btn-info">Add</a>
                    @endif

                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                             <th>S.N</th>
                               <th>Post Title</th>
                               <th>Requirements</th>
                               <th>Status</th>


                               <th>Action</th>

                            </tr>

                        </thead>

                        @if(!empty($positions))
                        @php($i=1)
                        @foreach ($positions as $position)


                        <tbody>

                        <tr>
                            <td>{{$i}}</td>

                            <td>{{$position->post_title}}</td>
                            <td>{!!$position->post_description!!}</td>
                               <td>                            
                        <span class="btn btn-rounded btn-sm bg-success text-white">Active</span>
                        </td>

                            <td>

                                <form action="/position/{{$position->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="/position/{{$position->id}}/edit" class="btn btn-info">Edit</a>
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

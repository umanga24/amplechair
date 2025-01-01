@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h1 >Team </h1>
                    @if(empty($back_team))
                    <a href="/back_team/create" class="float-end btn btn-info">Add</a>
                    @endif

                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>'
                                <th>S.N</th>

                               <th>Name</th>
                               <th>Designation</th>
                               <th>Status</th>


                               <th>Action</th>

                            </tr>

                        </thead>

                        @if(!empty($back_teams))
                        @php($i=1)
                        @foreach ($back_teams as $back_team)


                        <tbody>

                        <tr>
                            <td>{{$i}}</td>

                            <td>{{$back_team->name}}</td>
                            <td>{{$back_team->designation}}</td>
                            <td>                            
                        <span class="btn btn-rounded btn-sm bg-success text-white">Active</span>
                        </td>

                            <td>

                                <form action="/back_team/{{$back_team->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="/back_team/{{$back_team->id}}/edit" class="btn btn-info">Edit</a>
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

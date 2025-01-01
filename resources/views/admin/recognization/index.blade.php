@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                     <h1 >Recogniazation </h1>
                    @if(empty($recognization))
                    <a href="/recognization/create" class="float-end btn btn-info">Add</a>
                    @endif

                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>S.N</th>
                               <th>Link</th>
                               <th>Image</th>
                               <th>Status</th>


                               <th>Action</th>

                            </tr>

                        </thead>

                        @if(!empty($recognizations))
                        @php($i=1)
                        @foreach ($recognizations as $recognization)


                        <tbody>

                        <tr>
                            <td>{{$i}}</td>

                            <td>{{$recognization->link}}</td>
                            <td>  <img src="{{asset($recognization->image2)}}" height="120" width="120" alt=""></td>
                             <td>                            
                        <span class="btn btn-rounded btn-sm bg-success text-white">Active</span>
                        </td>

                            <td>

                                <form action="/recognization/{{$recognization->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="/recognization/{{$recognization->id}}/edit" class="btn btn-info">Edit</a>
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

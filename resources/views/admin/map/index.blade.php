@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Maps</h1>
                    @if(empty($map))
                    <a href="/map/create" class="float-end btn btn-info">Add</a>
                    @endif

                </div>

                <div class="card-body">
                    <table class="table table-striped" id='example-table'>
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Title</th>

                                <!--<th>Subtitle</th>-->

                                <!-- <th>Country</th>-->
                                <th>Description</th>
                                <!-- <th>Status</th>-->


                                <th>Action</th>

                            </tr>

                        </thead>

                        @if(!empty($maps))
                        @php($i=1)
                        @foreach ($maps as $map)


                        <tbody>

                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$map->title}}</td>




                                <td>{!!$map->description!!}</td>


                                <td>

                                    <form action="/map/{{$map->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="/map/{{$map->id}}/edit" class="btn btn-info">Edit</a>
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
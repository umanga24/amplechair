@extends('layouts.admin')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 >Sustainbility </h1>
                    @if(empty($sustain))
                    <a href="/sustain/create" class="float-end btn btn-info">Add</a>
                    @endif

                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>S.N</th>

                               <th>Shor_Description</th>
                               <th>Description</th>

                               <th>Status</th>


                               <th>Action</th>

                            </tr>

                        </thead>

                        @if(!empty($sustains))
                        @php($i=1)
                        @foreach ($sustains as $sustain)


                        <tbody>

                        <tr>
                            <td>{{$i}}</td>

                            <td>{{$sustain->short_description}}</td>
                            <td>{!!$sustain->description!!}</td>

                            <!--<td>active</td>-->
                        <td>                            
                        <span class="btn btn-rounded btn-sm bg-success text-white">Active</span>
                        </td>

                            <td>

                                <form action="/sustain/{{$sustain->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="/sustain/{{$sustain->id}}/edit" class="btn btn-info">Edit</a>
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

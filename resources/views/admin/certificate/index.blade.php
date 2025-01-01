@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h1>Certificates</h1>
                    @if(empty($document))
                    <a href="/document/create" class="float-end btn btn-info">Add</a>
                    @endif

                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>S.N</th>

                               <th>Shortificate_Title</th>
                               <th>Description</th>

                               <th>Status</th>


                               <th>Action</th>

                            </tr>

                        </thead>

                        @if(!empty($documents))
                        @php($i=1)
                        @foreach ($documents as $document)


                        <tbody>

                        <tr>
                            <td>{{$i}}</td>

                            <td>{{$document->certificate_title}}</td>
                            <td>{{$document->short_description}}</td>

                           <td>                            
                        <span class="btn btn-rounded btn-sm bg-success text-white">Active</span>
                        </td>

                            <td>

                                <form action="/document/{{$document->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="/document/{{$document->id}}/edit" class="btn btn-info">Edit</a>
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

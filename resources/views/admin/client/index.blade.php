@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h1>Clients</h1>
                    @if(empty($customer))
                    <a href="/customer/create" class="float-end btn btn-info">Add</a>
                    @endif

                </div>

                <div class="card-body">
                    <table class="table table-striped" id='example-table'>
                        <thead>
                            <tr>
                                <th>S.N</th>
                                  <th>Title</th>

                               <!--<th>Subtitle</th>-->
                             
                               <th>Country</th>
                               <!--<th>Description</th>-->
                               <th>Status</th>


                               <th>Action</th>

                            </tr>

                        </thead>

                        @if(!empty($customers))
                        @php($i=1)
                        @foreach ($customers as $customer)


                        <tbody>

                        <tr>
                            <td>{{$i}}</td>
                             <td>{{$customer->title}}</td>

                            <!--<td>{!!$customer->subtitle!!}</td>-->
                           
                            <td>{{$customer->country}}</td>
                            <!--<td>{!!$customer->description!!}</td>-->
                            <td>                            
                        <span class="btn btn-rounded btn-sm bg-success text-white">Active</span>
                        </td>

                            <td>

                                <form action="/customer/{{$customer->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="/customer/{{$customer->id}}/edit" class="btn btn-info">Edit</a>
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


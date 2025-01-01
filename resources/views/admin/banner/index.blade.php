@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Banners</h1>
                    <!--<span >Banners</span>-->
                    <!--@if(empty($banner))-->
                    <!--<a href="/banner/create" class="float-end btn btn-info">Add</a>-->
                    <!--@endif-->

                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>S.N</th>

                               
                               <th>Contact_Banner</th>
                               <th>Client_Banner</th>
                             
                               <th>Status</th>


                               <th>Action</th>

                            </tr>

                        </thead>

                        @if(!empty($banners))
                        @php($i=1)
                        @foreach ($banners as $banner)


                        <tbody>

                        <tr>
                            <td>{{$i}}</td>

                         
                            <td><img src="{{asset($banner->contact_banner)}}" height="150" width="150" alt=""></td>
                        
                            <td><img src="{{asset($banner->client_banner)}}" height="150" width="150" alt=""></td>
                             <td>                            
                        <span class="btn btn-rounded btn-sm bg-success text-white">Active</span>
                        </td>
                            <td>

                                <form action="/banner/{{$banner->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <a href="/admin/banner/{{$banner->id}}/edit" class="btn btn-info">Edit</a>
                                    {{-- <button type="submit" class="btn btn-danger">Delete</button> --}}

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

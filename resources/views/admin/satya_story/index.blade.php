@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <h1>About Us </h1>
                        @if (empty($about_us))
                            {{-- <a href="/about_us/create" class="float-end btn btn-info">Add</a> --}}
                        @endif

                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>

                                    <!--<th>Description</th>-->
                                    <th>Banner Image</th>
                                    <th>Status</th>


                                    <th>Action</th>

                                </tr>

                            </thead>

                            @if (!empty($about_uss))
                                @php($i = 1)
                                @foreach ($about_uss as $about_us)
                                    <tbody>

                                        <tr>
                                            <td>{{ $i }}</td>


                                            <!--<td>{!! $about_us->satya_description !!}</td>-->
                                            <td> <img src="{{asset($about_us->satya_banner)}}" height="100" width="100"
                                                    alt=""></td>
                                             <td>                            
                        <span class="btn btn-rounded btn-sm bg-success text-white">Active</span>
                        </td>

                                            <td>

                                                <form action="/about_us/{{ $about_us->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="/about_us/{{ $about_us->id }}/edit" class="btn btn-info">Edit</a>
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

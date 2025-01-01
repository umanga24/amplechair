@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span>Form</span>
                        @if (empty($post))
                    <a href="/post/create" class="float-end btn btn-info">Add</a>
                    @endif

                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                  <th>Post</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>

                                    <th>Status</th>


                                    <th>Action</th>

                                </tr>

                            </thead>

                            @if (!empty($posts))
                                @php($i = 1)
                                @foreach ($posts as $post)
                                    <tbody>

                                        <tr>
                                            <td>{{ $i }}</td>

                                            <td>{{ $post->post}}</td>
                                            <td>{{ $post->name}}</td>
                                            <td>{{ $post->email }}</td>
                                            <td>{{ $post->phone }}</td>
                                            <td>active</td>

                                            <td>

                                                <form action="/post/{{ $post->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="/post/{{ $post->id }}/edit" class="btn btn-info">Edit</a>
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

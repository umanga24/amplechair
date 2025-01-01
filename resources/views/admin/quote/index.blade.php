@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
  <h1>Quotes</h1>
                        @if (empty($quote))
                            {{-- <a href="/quote/create" class="float-end btn btn-info">Add</a> --}}
                        @endif

                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Title</th>
                                    <!--<th>Description</th>-->
                                    <th>Image</th>
                                    <th>Status</th>


                                    <th>Action</th>

                                </tr>

                            </thead>

                            @if (!empty($quotes))
                                @php($i = 1)
                                @foreach ($quotes as $quote)
                                    <tbody>

                                        <tr>
                                            <td>{{ $i }}</td>

                                            <td>{{ $quote->quote_title }}</td>
                                            <!--<td>{!! $quote->quote_description !!}</td>-->
                                            <td> <img src="{{ asset($quote->quote_image) }}" height="100" width="100"
                                                    alt=""></td>
                                           <td>                            
                        <span class="btn btn-rounded btn-sm bg-success text-white">Active</span>
                        </td>

                                            <td>

                                                <form action="/quote/{{ $quote->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="/quote/{{ $quote->id }}/edit" class="btn btn-info">Edit</a>
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

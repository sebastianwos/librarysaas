@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Dashboard <a class="btn btn-primary pull-right" href="/home">All Your Libraries</a></div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('libraries.update', ['library' => $library->id ]) }}">
                        {!! method_field('PUT') !!}
                        @include('libraries._form', compact('library'))
                    </form>
                    @if(count($library->books))
                    <table class="table">
                        <tbody class="dropzone-previews" id="preview">
                            <tr>
                                <th>Book Name</th>
                                <th>Author</th>
                                <th>Borrowing Period in Weeks</th>
                                <th class="text-right">Action</th>
                            </tr>
                            @foreach($library->books as $book)
                                <tr>
                                    <td><a href="{{ route('books.show', ['book' => $book->id]) }}">{{ $book->name }}</a></td>
                                    <td>{{ $book->author }}</td>
                                    <td class="text-center">{{ $book->period }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-xs btn-info" href="{{ route('books.edit', ['book' => $book->id]) }}">Edit</a>
                                        <form style="display: inline-block;" action="{{ route('books.destroy', ['book' => $book->id]) }}" method="POST">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}
                                            <button class="btn btn-xs btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    <form action="{{ route('libraries.upload', ['library' => $library->id ]) }}" class="dropzone" id="library">
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

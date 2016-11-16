@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <div class="form-group">
                        <a class="btn btn-primary" href="{{ route('libraries.create') }}">Add Your New Library</a>
                    </div>
                    @if(count($libraries))
                    <table class="table">
                        <tr>
                            <th>Library Name</th>
                            <th class="text-right">Action</th>
                        </tr>
                        @foreach($libraries as $library)
                            <tr>
                                <td>{{ $library->name }}</td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-default" href="{{ route('libraries.show', ['library' => $library->slug]) }}">Show</a>
                                    <a class="btn btn-xs btn-info" href="{{ route('libraries.edit', ['library' => $library->id]) }}">Edit</a>
                                    <form style="display: inline-block;" action="{{ route('libraries.destroy', ['library' => $library->id]) }}" method="POST">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button class="btn btn-xs btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @endif
                    @if($borrowedBooks->count())
                        <hr />
                        <h4>Books you are currently borrowed:</h4>
                        @foreach($borrowedBooks as $book)
                            <p>
                                <span class="pull-right">Return date {{ $book->return_at->toDateString() }}</span>
                                <form style="margin-right: 10px;" class="pull-right" action="{{ route('borrow.destroy', ['book' => $book->id]) }}" method="POST">
                                    {!! method_field('DELETE') !!}
                                    {!! csrf_field() !!}
                                    <button class="btn btn-danger btn-xs pull-right" type="submit">Return the book</button>
                                </form>
                                <a style="margin-right: 10px;" href="{{ route('reviews.show', ['book' => $book->id]) }}" class="btn btn-info btn-xs pull-right" href="">Add review</a>
                                <a href="{{ route('books.show', ['book' => $book->id]) }}">{{ $book->name }}</a>
                            </p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

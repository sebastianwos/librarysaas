@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Library: {{ $library->name }} by {{ $library->owner->name }}</div>
                <div class="panel-body">
                    <h4>Books: </h4>
                    <ul>
                        @foreach($library->books as $book)
                            <li>
                                <a class="btn btn-primary btn-xs" href="{{route('borrow.create', ['book' => $book->id])}}">Borrow this book</a>
                                {{ $book->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

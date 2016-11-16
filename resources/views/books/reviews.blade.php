@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <p class="pull-right">
                        Author: {{ $book->author }} <br>
                        Library: {{ $book->library->name }}<br>
                        Owner: {{ $book->library->owner->name }}
                    </p>
                    <h3 style="margin-top: 10px;">You are watching reviews for a book: {{ $book->name }}</h3>
                </div>
                <div class="panel-body">

                    <ul class="list-group">
                        @foreach($book->reviews as $review)
                            <li class="list-group-item">
                                <span class="pull-right">Rating: {{ $review->rating }}</span>
                                <p>Added: {{ $review->created_at->format('Y/m/d') }} by {{ $review->user->name }}</p>
                                <strong>{{ $review->comment }}</strong>
                            </li>
                        @endforeach
                    </ul>



                    @include('books.reviewform', ['book' => $book]);

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('books.update', ['book' => $book->id ]) }}">
                        {!! method_field('PUT') !!}
                        @include('books._form', compact('book'))
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

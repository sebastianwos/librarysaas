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
                    <h3 style="margin-top: 10px;">You are borrowing book: {{ $book->name }}</h3>
                </div>
                <div class="panel-body">
                    <h4>You may borrow this book until <strong>{{ $maxReturnDate->toDateString() }}</strong></h4>
                    <form method="POST" action="{{ route('borrow.store', ['book' => $book->id ]) }}">
                        {!! csrf_field() !!}
                        <div class="form-group {{ $errors->has('return_at') ? 'has-error' : null  }}">
                            <label for="return_at">Choose Return Date:</label>
                            <input type="date" name="return_at" value="{{ old('return_at') }}" class="form-control"/>
                            @if ($errors->has('return_at'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('return_at') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!--  Form Input -->
                        <div class="form-group">
                            <input type="submit" name="submit" value="Borrow Now!" class="btn btn-primary"/>
                            <a class="btn btn-danger" href="/">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

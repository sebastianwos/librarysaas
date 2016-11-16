@extends('layouts.app')
@section('content')
    <div class="content">
        <h2>Available Libraries:</h2>
        @if($libraries->count())
            <ul>
                @foreach($libraries as $library)
                    <li><a href="{{route('libraries.show', [ 'slug' => $library->slug ])}}">{{ $library->name }}</a></li>
                @endforeach
            </ul>
        @endif
    </div>
@stop
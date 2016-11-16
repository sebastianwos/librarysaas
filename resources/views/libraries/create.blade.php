@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Dashboard <a class="btn btn-primary pull-right" href="/home">All Your Libraries</a></div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('libraries.store') }}">
                        @include('libraries._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

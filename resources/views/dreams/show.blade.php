@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('dreams.show') }}</div>

                <div class="panel-body">
                    <h2>{{ $dream->getTitle() }}</h2>

                    <div class="jumbotron">
                        <p>{{ $dream->getBody() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


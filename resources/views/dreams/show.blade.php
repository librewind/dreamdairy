@extends('layouts.app')

@section('content')
    <div class="container">

        <nav class="navbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('dreams') }}">Все сны</a></li>
            </ul>
        </nav>

        <h1>{{ $dream->getTitle() }}</h1>

        <div class="jumbotron">
            <p>{{ $dream->getBody() }}</p>
        </div>

    </div>
@endsection


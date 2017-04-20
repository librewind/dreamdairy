@extends('layouts.app')

@section('content')
    <div class="container">

        <nav class="navbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('dreams') }}">Все сны</a></li>
            </ul>
        </nav>

        <h1>{{ $dream->getTitle() }}</h1>

        <!-- if there are creation errors, they will show here -->
        {{ Html::ul($errors->all()) }}

        {{ Form::model($dream, ['method' => 'PATCH', 'action' => ['DreamController@update', $dream->getId()]]) }}

        <div class="form-group">
            {{ Form::label('title', 'Заголовок') }}
            {{ Form::text('title', $dream->getTitle(), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('body', 'Содержание') }}
            {{ Form::textarea('body', $dream->getBody(), array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Редактировать', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@endsection

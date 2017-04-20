@extends('layouts.app')

@section('content')
    <div class="container">

        <nav class="navbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('dreams') }}">Все сны</a></li>
                <li><a href="{{ URL::to('dreams/create') }}">Добавить сон</a>
            </ul>
        </nav>

        <h1>Новый сон</h1>

        <!-- if there are creation errors, they will show here -->
        {{ Html::ul($errors->all()) }}

        {{ Form::open(array('url' => 'dreams')) }}

            {{  Form::hidden('user_id', Auth::user()->getId()) }}

            <div class="form-group">
                {{ Form::label('title', 'Заголовок') }}
                {{ Form::text('title', old('title'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('body', 'Содержимое') }}
                {{ Form::textarea('body', old('body'), array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Добавить сон', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>
@endsection

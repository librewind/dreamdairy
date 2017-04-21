@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('common.edit') }}</div>

                <div class="panel-body">
                    <div class="btn-group">
                        <a class="btn btn-small btn-default" href="{{ URL::to('dreams') }}">{{ __('dreams.all') }}</a>
                    </div>
                    <br>
                    <br>
                    {{ Html::ul($errors->all()) }}

                    {{ Form::model($dream, ['method' => 'PATCH', 'action' => ['DreamController@update', $dream->getId()]]) }}

                    {{  Form::hidden('user_id', Auth::user()->getId()) }}

                    <div class="form-group">
                        {{ Form::label('title', __('common.title')) }}
                        {{ Form::text('title', $dream->getTitle(), ['class' => 'form-control', 'autofocus' => 'autofocus']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('body', __('common.content')) }}
                        {{ Form::textarea('body', $dream->getBody(), ['class' => 'form-control']) }}
                    </div>

                    {{ Form::submit(__('common.edit2'), ['class' => 'btn btn-primary']) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

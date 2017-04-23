@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('dreams.new') }}</div>

                <div class="panel-body">
                    {{ Html::ul($errors->all()) }}

                    {{ Form::open(['url' => 'dreams']) }}

                        {{  Form::hidden('user_id', Auth::user()->getId()) }}

                        <div class="form-group">
                            {{ Form::label('title', __('common.title')) }}
                            {{ Form::text('title', old('title'), ['class' => 'form-control', 'autofocus' => 'autofocus']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('body', __('common.content')) }}
                            {{ Form::textarea('body', old('body'), ['class' => 'form-control']) }}
                        </div>

                        {{ Form::submit(__('dreams.add'), ['class' => 'btn btn-primary']) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

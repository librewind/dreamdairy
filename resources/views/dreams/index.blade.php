@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('dreams.dreams') }}</div>

                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>{{ __('common.title') }}</td>
                            <td>{{ __('common.date') }}</td>
                            <td>{{ __('dreams.dreamer') }}</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($dreams as $dream)
                                <tr>
                                    <td><a href="{{ url('dreams', [$dream->getId()]) }}">{{ $dream->getTitle() }}</a></td>
                                    <td></td>
                                    <td>{{ $dream->getUser()->getName() }}</td>
                                    <td>
                                        {{ Form::open(['url' => 'dreams/' . $dream->getId(), 'class' => 'pull-right']) }}
                                            <a class="btn btn-small btn-info" href="{{ URL::to('dreams/' . $dream->getId() . '/edit') }}">{{ __('common.edit') }}</a>
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::submit(__('common.delete'), ['class' => 'btn btn-warning']) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="btn btn-small btn-success" href="{{ URL::to('dreams/create') }}">{{ __('common.add') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">{{ __('dreams.recent') }}</div>

            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <td>{{ __('common.title') }}</td>
                        <td>{{ __('common.date') }}</td>
                        <td>{{ __('dreams.dreamer') }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($dreams as $dream)
                        <tr>
                            <td><a href="{{ url('dreams', [$dream->getId()]) }}">{{ $dream->getTitle() }}</a></td>
                            <td>{{ $dream->getCreated()->format('d.m.Y') }}</td>
                            <td>{{ $dream->getUser()->getName() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

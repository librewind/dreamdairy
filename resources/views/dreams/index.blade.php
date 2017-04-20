@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Сны</div>

                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>Заголовок</td>
                            <td>Дата</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($dreams as $dream)
                                <tr>
                                    <td><a href="{{ url('dreams', [$dream->getId()]) }}">{{ $dream->getTitle() }}</a></td>
                                    <td></td>
                                    <td>
                                        {{ Form::open(array('url' => 'dreams/' . $dream->getId(), 'class' => 'pull-right')) }}
                                            <a class="btn btn-small btn-info" href="{{ URL::to('dreams/' . $dream->getId() . '/edit') }}">Редактировать</a>
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::submit('Удалить', array('class' => 'btn btn-warning')) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="btn btn-small btn-success" href="{{ URL::to('dreams/create') }}">Добавить</a>
                </div>
            </div>
        </div>
    </div>
@endsection
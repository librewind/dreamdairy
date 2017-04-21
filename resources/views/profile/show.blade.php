@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('common.profile') }}</div>

                <div class="panel-body">
                    <div class="btn-group">
                        <a class="btn btn-small btn-default" href="{{ URL::to('profile/edit') }}">{{ __('common.edit2') }}</a>
                    </div>
                    <br>
                    <br>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{ __('auth.name') }}</label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{ $user->getName() }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{ __('auth.email') }}</label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{ $user->getEmail() }}</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

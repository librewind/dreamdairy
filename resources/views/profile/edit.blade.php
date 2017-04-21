@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('common.profile') }}</div>

                <div class="panel-body">
                    <div class="btn-group">
                        <a class="btn btn-small btn-default active" href="{{ URL::to('profile/edit') }}" disabled="disabled">{{ __('common.edit2') }}</a>
                    </div>
                    <br>
                    <br>
                    <form method="POST" action="{{ URL::to('profile') }}" accept-charset="UTF-8" class="form-horizontal">
                        <input name="_method" type="hidden" value="PUT">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">{{ __('auth.name') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('auth.name') }}" value="{{ $user->getName() }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{ __('auth.email') }}</label>
                            <div class="col-sm-10">
                                <p class="form-control-static">{{ $user->getEmail() }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">{{ __('common.save2') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

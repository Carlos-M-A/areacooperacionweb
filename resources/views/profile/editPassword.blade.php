@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">@lang('general.change_password')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('editPassword') }}">
                        {{ csrf_field() }}


                        <div id="password_div" class="form-group{{ $errors->has('currentPassword') ? ' has-error' : '' }} {{isset($passwordFail) ? 'has-error': ''}}">
                            <label for="currentPassword" class="col-md-4 control-label">@lang('general.current_password')</label>

                            <div class="col-md-6">
                                <input id="currentPassword" type="password" class="form-control" name="currentPassword" required autofocus>

                                @if(isset($passwordFail))
                                <span class="help-block">
                                    <strong>{{isset($passwordFail) ? $passwordFail : ''}}</strong>
                                </span>
                                @endif
                                @if ($errors->has('currentPassword'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('currentPassword') }}</strong>
                                </span>
                                @endif
                                
                                
                            </div>
                        </div>

                        
                        <div id="password_div" class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">@lang('general.new_password')</label>

                            <div class="col-md-6">
                                <input id="passwordNuevo" type="password" class="form-control" name="password" required autofocus>

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="password-confirm_div" class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">@lang('general.confirm_password')</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autofocus>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('general.save')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

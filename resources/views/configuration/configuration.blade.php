@extends('layouts.app')

@section('content')

            
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.navigationBar', ['active' => 7])
            <div class="panel panel-info">
                <div class="panel-heading">
                    @lang('general.configuration')
                    <ul class="nav nav-pills">
                        <li class="active"><a href="{{ route('configuration') }}">@lang('general.configuration')</a></li>
                        <li class=""><a href="{{ route('searchStudies', ['branch' => 0]) }}"> @lang('general.studies')</a></li>
                        <li class=""><a href="{{ route('showCreateStudy') }}"> @lang('general.create_study')</a></li>
                        <li class=""><a href="{{ route('searchCampuses') }}"> @lang('general.campuses')</a></li>
                        <li class=""><a href="{{ route('showCreateCampus') }}"> @lang('general.create_campus')</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('editConfiguration') }}">
                        {{ csrf_field() }}
                        
                    
                        <div id="appName_div" class="form-group{{ $errors->has('appName') ? ' has-error' : '' }}">
                            <label for="appName" class="col-md-4 control-label">@lang('general.app_name')</label>

                            <div class="col-md-6">
                                <input id="appName" type="text" maxlength="100" class="form-control" name="appName" value="{{ old('appName')? old('appName') : @config('app.name')}}" autofocus required>

                                @if ($errors->has('appName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('appName') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="linkInAppName_div" class="form-group{{ $errors->has('linkInAppName') ? ' has-error' : '' }}">
                            <label for="linkInAppName" class="col-md-4 control-label">@lang('general.app_url')</label>

                            <div class="col-md-6">
                                <input id="linkInAppName" type="url" maxlength="{{config('forms.url')}}" class="form-control" name="linkInAppName" value="{{ old('linkInAppName')? old('linkInAppName') : @config('app.link_in_app_name')}}" autofocus required>

                                @if ($errors->has('linkInAppName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('linkInAppName') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="newsletterActive_div" class="form-group{{ $errors->has('newsletterActive') ? ' has-error' : '' }}">
                            <label for="newsletterActive" class="col-md-4 control-label">@lang('general.newsletter_active')</label>

                            <div class="col-md-6">

                                <label class="radio-inline">
                                    <input id="radioYes" type="radio" name="newsletterActive" value="1" {{ config('app.newsletter_active') ? 'checked' : ''}}>
                                    @lang('general.yes')</label>
                                <label class="radio-inline">
                                    <input id='radioNo' type="radio" name="newsletterActive" value="0" {{ config('app.newsletter_active') ? '' : 'checked'}}>
                                    @lang('general.no')</label>
                                @if ($errors->has('newsletterActive'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('newsletterActive') }}</strong>
                                </span>
                                @endif
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
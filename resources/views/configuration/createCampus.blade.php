@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            @include('layouts.navigationBar', ['active' => 7])
            <div class="panel panel-info">
                <div class="panel-heading">@lang('general.configuration')
                    <ul class="nav nav-pills">
                        <li class=""><a href="{{ route('configuration') }}">@lang('general.configuration')</a></li>
                        <li class=""><a href="{{ route('searchStudies', ['branch' => 0]) }}"> @lang('general.studies')</a></li>
                        <li class=""><a href="{{ route('showCreateStudy') }}"> @lang('general.create_study')</a></li>
                        <li class=""><a href="{{ route('searchCampuses') }}"> @lang('general.campuses')</a></li>
                        <li class="active"><a href="{{ route('showCreateCampus') }}"> @lang('general.create_campus')</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('createCampus') }}">
                        {{ csrf_field() }}

                        <div id="nameDiv" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">@lang('models.name')</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus required>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div id="abbreviationDiv" class="form-group{{ $errors->has('abbreviation') ? ' has-error' : '' }}">
                            <label for="abbreviation" class="col-md-4 control-label">@lang('models.abbreviation')</label>

                            <div class="col-md-6">
                                <input id="abbreviation" type="text" class="form-control" name="abbreviation" value="{{ old('abbreviation') }}" autofocus required>

                                @if ($errors->has('abbreviation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('abbreviation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('general.create')
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
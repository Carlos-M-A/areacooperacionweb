@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> Campus </h1>
            
            <div class="panel panel-info">
                <div class="panel-heading">@lang('models.campus')</div>
                <div class="panel-body">
                     <li class="list-group-item"><b>@lang('models.name'):</b> {{$campus->name}}</li>
                        <li class="list-group-item"><b>@lang('models.abbreviation'):</b> @lang('models.abbreviation' . $campus->abbreviation)</li>
                        <li class="list-group-item"><b>@lang('models.state'):</b> {{$campus->inactive ? __('general.inactive') : __('general.active')}}</li>
                        
                </div>
                <div class="panel-footer">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeCampusToInactive', ['id'=> $campus->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{$campus->inactive? __('general.activate') : __('general.deactivate')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <div class="panel panel-info">
                <div class="panel-heading">@lang('general.edit_campus')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeCampusName', ['id'=> $campus->id]) }}">
                        {{ csrf_field() }}

                        <div id="nameDiv" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">@lang('models.name')</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"required>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('general.change')
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeCampusAbbreviation', ['id'=> $campus->id]) }}">
                        {{ csrf_field() }}

                        <div id="abbreviationDiv" class="form-group{{ $errors->has('abbreviation') ? ' has-error' : '' }}">
                            <label for="abbreviation" class="col-md-4 control-label">@lang('models.abbreviation')</label>

                            <div class="col-md-6">
                                <input id="abbreviation" type="text" class="form-control" name="abbreviation" value="{{ old('abbreviation') }}" required>

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
                                    @lang('general.change')
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
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
                        <li class=""><a href="{{ route('configuration') }}">@lang('general.configuration')</a></li>
                        <li class=""><a href="{{ route('searchStudies', ['branch' => 0]) }}"> @lang('general.studies')</a></li>
                        <li class="active"><a href="{{ route('showCreateStudy') }}"> @lang('general.create_study')</a></li>
                        <li class=""><a href="{{ route('searchCampuses') }}"> @lang('general.campuses')</a></li>
                        <li class=""><a href="{{ route('showCreateCampus') }}"> @lang('general.create_campus')</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('createStudy') }}">
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
                        

                        <div class="form-group{{ $errors->has('branch') ? ' has-error' : '' }}">
                            <label for="branch" class="col-md-4 control-label">@lang('models.branch')</label>

                            <div class="col-md-6">
                                <select  id="branch" class="form-control" name="branch" autofocus required>
                                    <option value="{{ old('branch') }}">{{old('branch') ? __('enums.branch_' . old('name')) : '' }}</option>
                                    <option value="1">Arts and Humanities</option>
                                    <option value="2">Sciences</option>
                                    <option value="3">Health sciences</option>
                                    <option value="4">Social and legal sciences</option>
                                    <option value="5">Engineering and architecture</option>
                                    <option value="6">Other</option>
                                </select>

                                @if ($errors->has('branch'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('branch') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group{{ $errors->has('campus') ? ' has-error' : '' }}">
                            <label for="campus" class="col-md-4 control-label">@lang('models.campus')</label>

                            <div class="col-md-6">
                                <select  id="campus" class="form-control" name="campus" autofocus required>
                                    <option value="{{ old('campus') }}">{{old('campus') ? App\Study::find( old('campus'))->name : ''}}</option>
                                    
                                    @php
                                        $faculties = App\Campus::all();
                                    @endphp
                                    @foreach($faculties as $campus)
                                    <option value="{{$campus->id}}">{{$campus->name}} - {{$campus->abbreviation}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('campus'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('campus') }}</strong>
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
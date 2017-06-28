@extends('layouts.app')

@section('content')

<ul class="pager">
    <li class="previous"><a href="{{ route('searchStudies', ['branch' => 0]) }}">@lang('pagination.previous')</a></li>
</ul>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="panel panel-info">
                <div class="panel-heading">@lang('models.study')</div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item"><b>@lang('models.name'):</b> {{$study->name}}</li>
                        <li class="list-group-item"><b>@lang('models.campus'):</b> <a href="{{route('campus', ['id'=> $study->campus->id])}}"> {{$study->campus->name}} </a></li>
                        <li class="list-group-item"><b>@lang('models.branch'):</b> @lang('enums.branch_' . $study->branch)</li>
                        <li class="list-group-item"><b>@lang('models.state'):</b> {{$study->inactive ? __('general.inactive') : __('general.active')}}</li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeStudyToInactive', ['id'=> $study->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{$study->inactive? __('general.activate') : __('general.deactivate')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <div class="panel panel-info">
                <div class="panel-heading">@lang('general.edit_study')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeStudyName', ['id'=> $study->id]) }}">
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
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('general.change')
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeStudyBranch', ['id'=> $study->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('branch') ? ' has-error' : '' }}">
                            <label for="branch" class="col-md-4 control-label">@lang('models.branch')</label>

                            <div class="col-md-6">
                                <select  id="branch" class="form-control" name="branch" autofocus required>
                                    <option value=""></option>
                                    <option value="1">@lang('enums.branch_1')</option>
                                    <option value="2">@lang('enums.branch_2')</option>
                                    <option value="3">@lang('enums.branch_3')</option>
                                    <option value="4">@lang('enums.branch_4')</option>
                                    <option value="5">@lang('enums.branch_5')</option>
                                    <option value="6">@lang('enums.branch_6')</option>
                                </select>

                                @if ($errors->has('branch'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('branch') }}</strong>
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
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeStudyCampus', ['id'=> $study->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('campus') ? ' has-error' : '' }}">
                            <label for="campus" class="col-md-4 control-label">Campus</label>

                            <div class="col-md-6">
                                <select  id="campus" class="form-control" name="campus" autofocus required>
                                    <option></option>
                                    
                                    @php
                                        $campuses = App\Campus::all();
                                    @endphp
                                    @foreach($campuses as $campus)
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
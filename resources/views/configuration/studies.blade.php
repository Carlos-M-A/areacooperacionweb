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
                        <li class="active"><a href="{{ route('searchStudies', ['branch' => 0]) }}"> @lang('general.studies')</a></li>
                        <li class=""><a href="{{ route('showCreateStudy') }}"> @lang('general.create_study')</a></li>
                        <li class=""><a href="{{ route('searchCampuses') }}"> @lang('general.campuses')</a></li>
                        <li class=""><a href="{{ route('showCreateCampus') }}"> @lang('general.create_campus')</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ route('searchStudies') }}">

                        <div class="form-group{{ $errors->has('branch') ? ' has-error' : '' }}">
                            <label for="branch" class="col-md-4 control-label">@lang('models.branch')</label>

                            <div class="col-md-6">
                                <select  id="branch" class="form-control" name="branch" autofocus>
                                    @if(old('branch')>0)
                                        <option value="{{old('branch')}}">@lang('enums.branch_' . old('branch'))</option>
                                        <option value="0">@lang('enums.branch_0')</option>
                                    @else
                                        <option value="0">@lang('enums.branch_0')</option>
                                    @endif
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

                        <div id="nameDiv" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

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
                                    @lang('general.search')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <div class="panel panel-info">
                <div class="panel-heading">Studys</div>

                <div class="panel-body">
                    
                                @foreach($studies as $study)
                                <li class="list-group-item">
                                 <a href="{{route('study', ['id'=> $study->id])}}" >{{$study->name}} - {{$study->campus->abbreviation}}</a>
                                
                                </li>
                                @endforeach
                            
                </div>
                
                <div class="panel-footer">
                    {{ $studies->appends(['branch' => old('branch'), 'name' => old('name')])->links() }}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
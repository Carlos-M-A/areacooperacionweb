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
                        <li class=""><a href="{{ route('showCreateStudy') }}"> @lang('general.create_study')</a></li>
                        <li class="active"><a href="{{ route('searchCampuses') }}"> @lang('general.campuses')</a></li>
                        <li class=""><a href="{{ route('showCreateCampus') }}"> @lang('general.create_campus')</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ route('searchCampuses') }}">

                        <div id="nameDiv" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">@lang('models.name')</label>

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
                <div class="panel-heading">@lang('general.campuses')</div>

                <div class="panel-body">
                    @foreach($campuses as $campus)
                    <li class="list-group-item">
                        <a href="{{route('campus', ['id'=> $campus->id])}}" >{{$campus->name}}</a>
                    </li>
                    @endforeach
                    
                </div>
                
                <div class="panel-footer">
                    {{ $campuses->appends(['name' => old('name')])->links() }}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')



@php
    $user = Auth::user();
@endphp


@section('more_script')
@yield('more_more_script')

<script>
    $( document ).ready(function() {
        $('textarea').keyup(function(event) {
            var text_max = $('#' + event.target.id).attr('maxlength');
            var text_length = $('#' + event.target.id).val().length;
            var text_remaining = text_max - text_length;
            
            $('#' + event.target.id).next().html(text_length + ' / ' + text_max);
        });
    });
</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.navigationBar', ['active' => 3])
            <div class="panel panel-info">
                <div class="panel-heading">
                    @lang('general.projects')
                    @if($user->role == 2)
                    <ul class="nav nav-pills">
                        <li class=""><a href="{{ route('myProjects') }}">@lang('general.my_projects')</a></li>
                        <li class="active"><a href="{{ route('showCreateProject') }}">@lang('general.create_project')</a></li>
                    </ul>
                    @elseif($user->role == 5)
                    <ul class="nav nav-pills">
                        <li class=""><a href="{{ route('finishedProjects') }}">@lang('general.finished_projects')</a></li>
                        <li class="active"><a href="{{ route('showCreateProject') }}">@lang('general.create_project')</a></li>
                    </ul>
                    @endif
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('createProject') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('studyId') ? ' has-error' : '' }}">
                            <label for="studyId" class="col-md-4 control-label">@lang('models.study')</label>

                            <div class="col-md-6">
                                <select  id="studyId" class="form-control" name="studyId" autofocus required>
                                    <option id="studyIdOption0" value="{{old('studyId') ? old('studyId') : ''}}">
                                        {{old('studyId') ? App\Study::find(old('studyId'))->name : ''}}
                                    </option>
                                    @if($user->role==5)
                                        @foreach(App\Study::where('inactive', false)->get() as $study)
                                            <option id="studyIdOption{{$study->id}}" value="{{$study->id}}">{{$study->name}} -- {{$study->campus->abbreviation}}</option>
                                        @endforeach
                                    @else
                                        @foreach($user->teacher->studies as $study)
                                            <option id="studyIdOption{{$study->id}}" value="{{$study->id}}">{{$study->name}} -- {{$study->campus->abbreviation}}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @if ($errors->has('studyId'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('studyId') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div id="title_div" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">@lang('models.title')</label>

                            <div class="col-md-6">
                                <textarea id="title" cols="100" rows="2" maxlength="{{config('forms.project_title')}}" placeholder="@lang('placeholders.project_title')"
                                           class="form-control" name="title" autofocus required>{{ old('title') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="scope_div" class="form-group{{ $errors->has('scope') ? ' has-error' : '' }}">
                            <label for="scope" class="col-md-4 control-label">@lang('models.scope')</label>

                            <div class="col-md-6">
                                <input id="scope" type="text" maxlength="{{config('forms.scope')}}"  placeholder="@lang('placeholders.scope')"
                                       class="form-control" name="scope" value="{{ old('scope') }}" autofocus required>

                                @if ($errors->has('scope'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('scope') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div id="description_div" class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">@lang('models.description')</label>

                            <div class="col-md-6">
                                <textarea id="description" cols="100" rows="7" maxlength="{{config('forms.project_description')}}" placeholder="@lang('placeholders.project_description')"
                                           class="form-control" name="description" autofocus required>{{ old('description') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        @yield('more_fields')
                        
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

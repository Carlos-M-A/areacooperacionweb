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
            <div class="panel panel-default">
                <div class="panel-heading">Create project</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('createProject') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('studyId') ? ' has-error' : '' }}">
                            <label for="studyId" class="col-md-4 control-label">Study</label>

                            <div class="col-md-6">
                                <select  id="studyId" class="form-control" name="studyId" autofocus>
                                    <option id="studyIdOption0" value="{{old('studyId') ? old('studyId') : ''}}">
                                        {{old('studyId') ? App\Study::find(old('studyId'))->name : ''}}
                                    </option>
                                    @if($user->role==5)
                                        @foreach(App\Study::all() as $study)
                                            <option id="studyIdOption{{$study->id}}" value="{{$study->id}}">{{$study->name}} -- {{$study->faculty->city}}</option>
                                        @endforeach
                                    @else
                                        @foreach($user->teacher->studies as $study)
                                            <option id="studyIdOption{{$study->id}}" value="{{$study->id}}">{{$study->name}} -- {{$study->faculty->city}}</option>
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
                            <label for="title" class="col-md-4 control-label">title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" autofocus>

                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="scope_div" class="form-group{{ $errors->has('scope') ? ' has-error' : '' }}">
                            <label for="scope" class="col-md-4 control-label">scope</label>

                            <div class="col-md-6">
                                <input id="scope" type="text" class="form-control" name="scope" value="{{ old('scope') }}" autofocus>

                                @if ($errors->has('scope'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('scope') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div id="description_div" class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">description</label>

                            <div class="col-md-6">
                                <textarea id="description" cols="100" rows="7" maxlength="{{config('forms.project_description')}}"
                                           class="form-control" name="description" autofocus>{{ old('description') }}</textarea>
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
                                    Create
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

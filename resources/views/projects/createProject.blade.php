@extends('layouts.app')

@section('content')

@php
    $teacher = App\Teacher::find(Auth::user()->id);
@endphp

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create project</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('createProject') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('studyId') ? ' has-error' : '' }}">
                            <label for="studyId" class="col-md-4 control-label">Type</label>

                            <div class="col-md-6">
                                <select  id="studyId" class="form-control" name="studyId" autofocus>
                                    <option id="studyIdOption0" value="{{old('studyId') ? old('studyId') : 0}}">
                                        {{old('studyId') ? App\Study::find(old('studyId'))->name : '-- Study --'}}
                                    </option>
                                    @foreach($teacher->studies as $study)
                                    <option id="studyIdOption{{$study->id}}" value="{{$study->id}}">{{$study->name}} -- {{$study->faculty->city}}</option>
                                    @endforeach
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
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" autofocus>

                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


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

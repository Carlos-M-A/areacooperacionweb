@extends('projects.editProject')

@section('more_more_script')

    <link rel="stylesheet" href="{{url('css/bootstrap-datepicker.min.css')}}" />
    <script src="{{url('js/bootstrap-datepicker.min.js')}}"></script>
    
<script>
    $( document ).ready(function() {
        $('#finishedDate').datepicker({
            format: "yyyy-mm-dd",
            weekStart: 1,
            endDate: "tomorrow"
        });
    });
</script>
@endsection

@section('more_fields')
@if($project->createdByAdmin)

<div class="form-group{{ $errors->has('studyId') ? ' has-error' : '' }}">
                            <label for="studyId" class="col-md-4 control-label">Study</label>

                            <div class="col-md-6">
                                <select  id="studyId" class="form-control" name="studyId" autofocus>
                                    <option id="studyIdOption0" value="{{old('studyId') ? old('studyId') : $project->study->id}}">
                                        {{old('studyId') ? App\Study::find(old('studyId'))->name : $project->study->name}}
                                    </option>
                                        @foreach(App\Study::all() as $study)
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

<div id="tutor_div" class="form-group{{ $errors->has('tutor') ? ' has-error' : '' }}">
    <label for="tutor" class="col-md-4 control-label">tutor</label>

    <div class="col-md-6">
        <input id="tutor" type="text" class="form-control" name="tutor" value="{{ old('tutor')?old('tutor') : $project->tutor }}" autofocus>

        @if ($errors->has('tutor'))
        <span class="help-block">
            <strong>{{ $errors->first('tutor') }}</strong>
        </span>
        @endif
    </div>
</div>

<div id="author_div" class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
    <label for="author" class="col-md-4 control-label">author</label>

    <div class="col-md-6">
        <input id="author" type="text" class="form-control" name="author" value="{{ old('author')?old('author') : $project->author }}" autofocus>

        @if ($errors->has('author'))
        <span class="help-block">
            <strong>{{ $errors->first('author') }}</strong>
        </span>
        @endif
    </div>
</div>
@endif

<div id="finishedDate_div" class="form-group{{ $errors->has('finishedDate') ? ' has-error' : '' }}">
    <label for="finishedDate" class="col-md-4 control-label">finishedDate</label>

    <div class="col-md-6">
        <input id="finishedDate" type="text" class="form-control" name="finishedDate" value="{{ old('finishedDate')?old('finishedDate') : $project->finishedDate }}" autofocus>
        @if ($errors->has('finishedDate'))
        <span class="help-block">
            <strong>{{ $errors->first('finishedDate') }}</strong>
        </span>
        @endif
    </div>
</div>
@endsection

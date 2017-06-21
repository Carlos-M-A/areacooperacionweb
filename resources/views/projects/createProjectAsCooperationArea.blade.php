@extends('projects.createProject')

@section('more_more_script')


    <link rel="stylesheet" href="{{URL::asset('css/bootstrap-datepicker.min.css')}}" />
    <script src="{{URL::asset('js/bootstrap-datepicker.min.js')}}"></script>
    
<script>
    $( document ).ready(function() {
        $('#finishedDate').datepicker({
            format: "yyyy-mm-dd",
            weekStart: 1,
            endDate: "tomorrow",
            startView: 2,
            maxViewMode: 2
        });
    });
</script>

@endsection

@section('more_fields')
<div id="tutor_div" class="form-group{{ $errors->has('tutor') ? ' has-error' : '' }}">
    <label for="tutor" class="col-md-4 control-label">@lang('models.tutor')</label>

    <div class="col-md-6">
        <input id="tutor" type="text" maxlength="{{config('forms.tutor')}}"  class="form-control" name="tutor" value="{{ old('tutor') }}" autofocus required>

        @if ($errors->has('tutor'))
        <span class="help-block">
            <strong>{{ $errors->first('tutor') }}</strong>
        </span>
        @endif
    </div>
</div>

<div id="author_div" class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
    <label for="author" class="col-md-4 control-label">@lang('models.author')</label>

    <div class="col-md-6">
        <input id="author" type="text" maxlength="{{config('forms.author')}}"  class="form-control" name="author" value="{{ old('author') }}" autofocus required>

        @if ($errors->has('author'))
        <span class="help-block">
            <strong>{{ $errors->first('author') }}</strong>
        </span>
        @endif
    </div>
</div>

<div id="urlDocumentation_div" class="form-group{{ $errors->has('urlDocumentation') ? ' has-error' : '' }}">
    <label for="urlDocumentation" class="col-md-4 control-label">@lang('models.urlDocumentation')</label>

    <div class="col-md-6">
        <input id="urlDocumentation" type="url" maxlength="{{config('forms.url')}}"  class="form-control" name="urlDocumentation" value="{{ old('urlDocumentation') }}" autofocus required>

        @if ($errors->has('urlDocumentation'))
        <span class="help-block">
            <strong>{{ $errors->first('urlDocumentation') }}</strong>
        </span>
        @endif
    </div>
</div>

<div id="finishedDate_div" class="form-group{{ $errors->has('finishedDate') ? ' has-error' : '' }}">
    <label for="finishedDate" class="col-md-4 control-label">@lang('models.finishedDate')</label>

    <div class="col-md-6">
        <input id="finishedDate" type="text" class="form-control" name="finishedDate" value="{{ old('finishedDate') }}" autofocus required>
        @if ($errors->has('finishedDate'))
        <span class="help-block">
            <strong>{{ $errors->first('finishedDate') }}</strong>
        </span>
        @endif
    </div>
</div>
@endsection

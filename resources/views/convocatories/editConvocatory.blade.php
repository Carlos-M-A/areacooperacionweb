@extends('layouts.app')

@section('more_script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    
<script>
    $( document ).ready(function() {
        $('#deadline').datepicker({
            format: "yyyy-mm-dd",
            weekStart: 1,
            startDate: "tomorrow"
        });
    });
</script>

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
                <div class="panel-heading">Create convocatory</div>
                <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('editConvocatory', ['id' => $convocatory->id]) }}">
                        {{ csrf_field() }}
                        
                    
                        <div id="title_div" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') ?  old('title') : $convocatory->title}}" autofocus>

                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div id="information_div" class="form-group{{ $errors->has('information') ? ' has-error' : '' }}">
                            <label for="information" class="col-md-4 control-label">information</label>

                            <div class="col-md-6">
                                <textarea id="information" cols="200" rows="7" maxlength="{{config('forms.information')}}"
                                           class="form-control" name="information" autofocus>{{ old('information')?old('information') : $convocatory->information }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('information'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('information') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="estimatedPeriod_div" class="form-group{{ $errors->has('estimatedPeriod') ? ' has-error' : '' }}">
                            <label for="estimatedPeriod" class="col-md-4 control-label">estimatedPeriod</label>

                            <div class="col-md-6">
                                <textarea id="estimatedPeriod" cols="200" rows="7" maxlength="{{config('forms.estimatedPeriod')}}"
                                           class="form-control" name="estimatedPeriod" autofocus>{{ old('estimatedPeriod')?old('estimatedPeriod') : $convocatory->estimatedPeriod }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('estimatedPeriod'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('estimatedPeriod') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="urlDocumentation_div" class="form-group{{ $errors->has('urlDocumentation') ? ' has-error' : '' }}">
                            <label for="urlDocumentation" class="col-md-4 control-label">urlDocumentation</label>

                            <div class="col-md-6">
                                <input id="urlDocumentation" type="text" class="form-control" name="urlDocumentation" value="{{ old('urlDocumentation') ?  old('urlDocumentation') : $convocatory->urlDocumentation}}" autofocus>

                                @if ($errors->has('urlDocumentation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('urlDocumentation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="deadline_div" class="form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">
                            <label for="deadline" class="col-md-4 control-label">deadline</label>

                            <div class="col-md-6">
                                <input id="deadline" type="date" class="form-control" name="deadline" value="{{ old('deadline') ?  old('deadline') : $convocatory->deadline}}" autofocus>

                                @if ($errors->has('deadline'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('deadline') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                   Save
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

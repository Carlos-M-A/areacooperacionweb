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
                <div class="panel-heading">Create offer</div>
                <div class="panel-body">
                    @if(Auth::user()->role==4)
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('createOffer') }}">
                    @else
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('createOfferManagedByArea') }}">
                    @endif
                        {{ csrf_field() }}
                        
                    
                        
                    @yield('convocatory_option') 
                    
                    
                    
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
                                <textarea id="description" cols="200" rows="7" maxlength="{{config('forms.project_description')}}"
                                           class="form-control" name="description" autofocus>{{ old('description') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="requeriments_div" class="form-group{{ $errors->has('requeriments') ? ' has-error' : '' }}">
                            <label for="requeriments" class="col-md-4 control-label">requeriments</label>

                            <div class="col-md-6">
                                <textarea id="requeriments" cols="100" rows="7" maxlength="{{config('forms.requeriments')}}"
                                           class="form-control" name="requeriments" autofocus>{{ old('requeriments') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('requeriments'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('requeriments') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="workplan_div" class="form-group{{ $errors->has('workplan') ? ' has-error' : '' }}">
                            <label for="workplan" class="col-md-4 control-label">workplan</label>

                            <div class="col-md-6">
                                <textarea id="workplan" cols="100" rows="7" maxlength="{{config('forms.workplan')}}"
                                           class="form-control" name="workplan" autofocus>{{ old('workplan') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('workplan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('workplan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="schedule_div" class="form-group{{ $errors->has('schedule') ? ' has-error' : '' }}">
                            <label for="schedule" class="col-md-4 control-label">schedule</label>

                            <div class="col-md-6">
                                <textarea id="schedule" cols="100" rows="7" maxlength="{{config('forms.schedule')}}"
                                           class="form-control" name="schedule" autofocus>{{ old('schedule') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('schedule'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="totalHours_div" class="form-group{{ $errors->has('totalHours') ? ' has-error' : '' }}">
                            <label for="totalHours" class="col-md-4 control-label">totalHours</label>

                            <div class="col-md-6">
                                <textarea id="totalHours" cols="100" rows="7" maxlength="{{config('forms.offer_totalHours')}}"
                                           class="form-control" name="totalHours" autofocus>{{ old('totalHours') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('totalHours'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('totalHours') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="possibleStartDates_div" class="form-group{{ $errors->has('possibleStartDates') ? ' has-error' : '' }}">
                            <label for="possibleStartDates" class="col-md-4 control-label">possibleStartDates</label>

                            <div class="col-md-6">
                                <textarea id="possibleStartDates" cols="100" rows="7" maxlength="{{config('forms.possibleStartDates')}}"
                                           class="form-control" name="possibleStartDates" autofocus>{{ old('possibleStartDates') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('possibleStartDates'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('possibleStartDates') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="possibleEndDates_div" class="form-group{{ $errors->has('possibleEndDates') ? ' has-error' : '' }}">
                            <label for="possibleEndDates" class="col-md-4 control-label">possibleEndDates</label>

                            <div class="col-md-6">
                                <textarea id="possibleEndDates" cols="100" rows="7" maxlength="{{config('forms.possibleEndDates')}}"
                                           class="form-control" name="possibleEndDates" autofocus>{{ old('possibleEndDates') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('possibleEndDates'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('possibleEndDates') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="places_div" class="form-group{{ $errors->has('places') ? ' has-error' : '' }}">
                            <label for="places" class="col-md-4 control-label">places</label>

                            <div class="col-md-6">
                                <input id="places" type="number" class="form-control" name="places" value="{{ old('places') }}" autofocus>

                                @if ($errors->has('places'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('places') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="monetaryHelp_div" class="form-group{{ $errors->has('monetaryHelp') ? ' has-error' : '' }}">
                            <label for="monetaryHelp" class="col-md-4 control-label">monetaryHelp</label>

                            <div class="col-md-6">
                                <textarea id="monetaryHelp" cols="100" rows="7" maxlength="{{config('forms.monetaryHelp')}}"
                                           class="form-control" name="monetaryHelp" autofocus>{{ old('monetaryHelp') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('monetaryHelp'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('monetaryHelp') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    
                        @yield('more_offer_fields') 
                        
                        <div id="personInCharge_div" class="form-group{{ $errors->has('personInCharge') ? ' has-error' : '' }}">
                            <label for="personInCharge" class="col-md-4 control-label">personInCharge</label>

                            <div class="col-md-6">
                                <input id="personInCharge" type="text" class="form-control" name="personInCharge" value="{{ old('personInCharge') }}" autofocus>

                                @if ($errors->has('personInCharge'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('personInCharge') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="deadline_div" class="form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">
                            <label for="deadline" class="col-md-4 control-label">deadline</label>

                            <div class="col-md-6">
                                <div id="sandbox-container">
                                    <input id="deadline" type="text" class="form-control" name="deadline" value="{{old('deadline')}}">
                                </div>
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

<script>
    
   
</script>
@endsection

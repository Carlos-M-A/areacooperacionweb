@extends('layouts.app')

@section('more_script')
<link rel="stylesheet" href="{{url('css/bootstrap-datepicker.min.css')}}" />
    <script src="{{url('js/bootstrap-datepicker.min.js')}}"></script>
    
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
            <div class="panel panel-primary">
                <div class="panel-heading">@lang('general.edit_data')</div>
                <div class="panel-body">
                    
                    @if(Auth::user()->role==4)
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('editOffer', ['id'=> $offer->id]) }}">
                    @else
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('editOfferManagedByArea', ['id'=> $offer->id]) }}">
                    @endif
                        {{ csrf_field() }}

                        @yield('convocatory_option')
                        
                        <div id="title_div" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">@lang('models.title')</label>

                            <div class="col-md-6">
                                <textarea id="title" cols="200" rows="1" maxlength="{{config('forms.offer_title')}}"
                                           class="form-control" name="title" autofocus required>{{ old('title')?old('title') : $offer->title }}</textarea>
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
                                <input id="scope" type="text" maxlength="{{config('forms.scope')}}" class="form-control" name="scope" value="{{ old('scope')?old('scope') : $offer->scope }}" autofocus>

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
                                 <textarea id="description" cols="200" rows="7" maxlength="{{config('forms.offer_description')}}"
                                           class="form-control" name="description" autofocus>{{ old('description')?old('description') : $offer->description }}</textarea>
                                           <span class="pull-right label label-default"></span>

                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="requeriments_div" class="form-group{{ $errors->has('requeriments') ? ' has-error' : '' }}">
                            <label for="requeriments" class="col-md-4 control-label">@lang('models.requeriments')</label>

                            <div class="col-md-6">
                                <textarea id="requeriments" cols="200" rows="2" maxlength="{{config('forms.requeriments')}}"
                                           class="form-control" name="requeriments" autofocus>{{ old('requeriments')?old('requeriments') : $offer->requeriments }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('requeriments'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('requeriments') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="workplan_div" class="form-group{{ $errors->has('workplan') ? ' has-error' : '' }}">
                            <label for="workplan" class="col-md-4 control-label">@lang('models.workplan')</label>

                            <div class="col-md-6">
                                <textarea id="workplan" cols="200" rows="3" maxlength="{{config('forms.workplan')}}"
                                           class="form-control" name="workplan" autofocus>{{ old('workplan')?old('workplan') : $offer->workplan }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('workplan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('workplan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="schedule_div" class="form-group{{ $errors->has('schedule') ? ' has-error' : '' }}">
                            <label for="schedule" class="col-md-4 control-label">@lang('models.schedule')</label>

                            <div class="col-md-6">
                                <textarea id="schedule" cols="200" rows="2" maxlength="{{config('forms.schedule')}}"
                                           class="form-control" name="schedule" autofocus>{{ old('schedule')?old('schedule') : $offer->schedule }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('schedule'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('schedule') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="totalHours_div" class="form-group{{ $errors->has('totalHours') ? ' has-error' : '' }}">
                            <label for="totalHours" class="col-md-4 control-label">@lang('models.totalHours')</label>

                            <div class="col-md-6">
                                <textarea id="totalHours" cols="200" rows="1" maxlength="{{config('forms.offer_totalHours')}}"
                                           class="form-control" name="totalHours" autofocus>{{ old('totalHours')?old('totalHours') : $offer->totalHours }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('totalHours'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('totalHours') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="possibleStartDates_div" class="form-group{{ $errors->has('possibleStartDates') ? ' has-error' : '' }}">
                            <label for="possibleStartDates" class="col-md-4 control-label">@lang('models.possibleStartDates')</label>

                            <div class="col-md-6">
                                <textarea id="possibleStartDates" cols="200" rows="1" maxlength="{{config('forms.possibleStartDates')}}"
                                           class="form-control" name="possibleStartDates" autofocus>{{ old('possibleStartDates')?old('possibleStartDates') : $offer->possibleStartDates }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('possibleStartDates'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('possibleStartDates') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="possibleEndDates_div" class="form-group{{ $errors->has('possibleEndDates') ? ' has-error' : '' }}">
                            <label for="possibleEndDates" class="col-md-4 control-label">@lang('models.possibleEndDates')</label>

                            <div class="col-md-6">
                                <textarea id="possibleEndDates" cols="200" rows="1" maxlength="{{config('forms.possibleEndDates')}}"
                                           class="form-control" name="possibleEndDates" autofocus>{{ old('possibleEndDates')?old('possibleEndDates') : $offer->possibleEndDates }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('possibleEndDates'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('possibleEndDates') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="places_div" class="form-group{{ $errors->has('places') ? ' has-error' : '' }}">
                            <label for="places" class="col-md-4 control-label">@lang('models.places')</label>

                            <div class="col-md-6">
                                <input id="places" type="number" min="1" max="{{config('forms.max_places')}}"  class="form-control" name="places" value="{{ old('places')?old('places') : $offer->places }}" autofocus>

                                @if ($errors->has('places'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('places') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="monetaryHelp_div" class="form-group{{ $errors->has('monetaryHelp') ? ' has-error' : '' }}">
                            <label for="monetaryHelp" class="col-md-4 control-label">@lang('models.monetaryHelp')</label>

                            <div class="col-md-6">
                                <textarea id="monetaryHelp" cols="200" rows="1" maxlength="{{config('forms.monetaryHelp')}}"
                                           class="form-control" name="monetaryHelp" autofocus>{{ old('monetaryHelp')?old('monetaryHelp') : $offer->monetaryHelp }}</textarea>
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
                            <label for="personInCharge" class="col-md-4 control-label">@lang('models.personInCharge')</label>

                            <div class="col-md-6">
                                <input id="personInCharge" type="text" maxlength="{{config('forms.personInCharge')}}" class="form-control" name="personInCharge" value="{{ old('personInCharge')?old('personInCharge') : $offer->personInCharge }}" autofocus>

                                @if ($errors->has('personInCharge'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('personInCharge') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="deadline_div" class="form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">
                            <label for="deadline" class="col-md-4 control-label">@lang('models.deadline')</label>

                            <div class="col-md-6">
                                <input id="deadline" type="date" class="form-control" name="deadline" value="{{ old('deadline')?old('deadline') : $offer->deadline }}" autofocus>

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
                                    @lang('general.save')
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
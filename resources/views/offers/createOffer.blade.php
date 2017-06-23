@extends('layouts.app')

@section('more_script')
<link rel="stylesheet" href="{{URL::asset('css/bootstrap-datepicker.min.css')}}" />
    <script src="{{URL::asset('js/bootstrap-datepicker.min.js')}}"></script>
    <!--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    -->
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

@php
    $user = Auth::user();
@endphp


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.navigationBar', ['active' => 1])
            <div class="panel panel-info">
                <div class="panel-heading">
                    @lang('general.offers')
                    @if($user->role == 4 || $user->role == 5)
                    <ul class="nav nav-pills">
                        <li class=""><a href="{{ route('myOffers') }}">@lang('general.my_offers')</a></li>
                        <li class=""><a href="{{ route('myOpenOffers') }}">@lang('general.my_open_offers')</a></li>
                        <li class=""><a href="{{ route('myClosedOffers') }}">@lang('general.my_closed_offers')</a></li>
                        <li class="active"><a href="{{ route('showCreateOffer') }}">@lang('general.create_offer')</a></li>
                    </ul>
                    @endif
                </div>
                <div class="panel-body">
                    @if(Auth::user()->role==4)
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('createOffer') }}">
                    @else
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('createOfferManagedByArea') }}">
                    @endif
                        {{ csrf_field() }}
                        
                    
                        
                    @yield('convocatory_option') 
                    
                    
                    
                        <div id="title_div" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">@lang('models.title')</label>

                            <div class="col-md-6">
                                <textarea id="title" cols="200" rows="1" maxlength="{{config('forms.offer_title')}}"
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
                                <input id="scope" type="text" maxlength="{{config('forms.scope')}}"class="form-control" name="scope" value="{{ old('scope') }}" autofocus required>

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
                                <textarea id="description" cols="200" rows="7" maxlength="{{config('forms.project_description')}}"
                                           class="form-control" name="description" autofocus required>{{ old('description') }}</textarea>
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
                                <textarea id="requeriments" cols="100" rows="2" maxlength="{{config('forms.requeriments')}}"
                                           class="form-control" name="requeriments" autofocus required>{{ old('requeriments') }}</textarea>
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
                                <textarea id="workplan" cols="100" rows="3" maxlength="{{config('forms.workplan')}}"
                                           class="form-control" name="workplan" autofocus required>{{ old('workplan') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('workplan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('workplan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    
                        <div id="workplace_div" class="form-group{{ $errors->has('workplace') ? ' has-error' : '' }}">
                            <label for="workplace" class="col-md-4 control-label">@lang('models.workplace')</label>

                            <div class="col-md-6">
                                <textarea id="workplace" cols="100" rows="2" maxlength="{{config('forms.workplace')}}"
                                           class="form-control" name="workplace" autofocus required>{{ old('workplace') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('workplace'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('workplace') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="schedule_div" class="form-group{{ $errors->has('schedule') ? ' has-error' : '' }}">
                            <label for="schedule" class="col-md-4 control-label">@lang('models.schedule')</label>

                            <div class="col-md-6">
                                <textarea id="schedule" cols="100" rows="2" maxlength="{{config('forms.schedule')}}"
                                           class="form-control" name="schedule" autofocus required>{{ old('schedule') }}</textarea>
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
                                <textarea id="totalHours" cols="100" rows="1" maxlength="{{config('forms.offer_totalHours')}}"
                                           class="form-control" name="totalHours" autofocus required>{{ old('totalHours') }}</textarea>
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
                                <textarea id="possibleStartDates" cols="100" rows="1" maxlength="{{config('forms.possibleStartDates')}}"
                                           class="form-control" name="possibleStartDates" autofocus required>{{ old('possibleStartDates') }}</textarea>
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
                                <textarea id="possibleEndDates" cols="100" rows="1" maxlength="{{config('forms.possibleEndDates')}}"
                                           class="form-control" name="possibleEndDates" autofocus required>{{ old('possibleEndDates') }}</textarea>
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
                                <input id="places" type="number" min="1" max="{{config('forms.max_places')}}" class="form-control" name="places" value="{{ old('places') }}" autofocus required>

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
                                <textarea id="monetaryHelp" cols="100" rows="1" maxlength="{{config('forms.monetaryHelp')}}"
                                           class="form-control" name="monetaryHelp" autofocus required>{{ old('monetaryHelp') }}</textarea>
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
                                <input id="personInCharge" type="text" maxlength="{{config('forms.personInCharge')}}" class="form-control" name="personInCharge" value="{{ old('personInCharge') }}" autofocus required>

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
                                <div id="sandbox-container">
                                    <input id="deadline" type="text" class="form-control" name="deadline" value="{{old('deadline')}}" required>
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

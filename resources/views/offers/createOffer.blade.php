@extends('layouts.app')

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
                        
                    
                        
                    @yield('more_offer_fields') 
                    
                    
                    
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
                        
                        <div id="requeriments_div" class="form-group{{ $errors->has('requeriments') ? ' has-error' : '' }}">
                            <label for="requeriments" class="col-md-4 control-label">requeriments</label>

                            <div class="col-md-6">
                                <input id="requeriments" type="text" class="form-control" name="requeriments" value="{{ old('requeriments') }}" autofocus>

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
                                <input id="workplan" type="text" class="form-control" name="workplan" value="{{ old('workplan') }}" autofocus>

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
                                <input id="schedule" type="text" class="form-control" name="schedule" value="{{ old('schedule') }}" autofocus>

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
                                <input id="totalHours" type="text" class="form-control" name="totalHours" value="{{ old('totalHours') }}" autofocus>

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
                                <input id="possibleStartDates" type="text" class="form-control" name="possibleStartDates" value="{{ old('possibleStartDates') }}" autofocus>

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
                                <input id="possibleEndDates" type="text" class="form-control" name="possibleEndDates" value="{{ old('possibleEndDates') }}" autofocus>

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
                                <input id="monetaryHelp" type="text" class="form-control" name="monetaryHelp" value="{{ old('monetaryHelp') }}" autofocus>

                                @if ($errors->has('monetaryHelp'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('monetaryHelp') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
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
                                <input id="deadline" type="date" class="form-control" name="deadline" value="{{ old('deadline') }}" autofocus>

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

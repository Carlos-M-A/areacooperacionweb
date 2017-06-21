@extends('offers.offer')

@section('offer_options')

@endsection

@section('more_script')
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

@section('student_proposal')

@if(is_null($proposal))

@if($offer->isOfferOfConvocatory && ! Auth::user()->student->isAcceptedInConvocatory($offer->offerOfConvocatory->convocatory))
    No estas aceptado en la convocatoria de esta oferta
@else
<div class="panel panel-default">
                <div class="panel-heading">@lang('general.create_proposal')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('createProposal', ['id' => $offer->id]) }}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">@lang('models.type')</label>

                            <div class="col-md-6">
                                <select  id="type" class="form-control" name="type" autofocus required>
                                    <option id="typeOption0" value="{{ old('type')? old('type') : ''}}">{{ old('type')? __('enums.proposal_type_'.old('type')) : ''}}</option>
                                    <option id="typeOption1" value="1">@lang('enums.proposal_type_1')</option>
                                    <option id="typeOption2" value="2">@lang('enums.proposal_type_2')</option>
                                </select>

                                @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div id="description_div" class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">@lang('models.description')</label>

                            <div class="col-md-6">
                                <textarea id="description" cols="100" rows="3" maxlength="{{config('forms.proposal_description')}}"
                                           class="form-control" name="description" autofocus required>{{ old('description') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="scheduleAvailable_div" class="form-group{{ $errors->has('scheduleAvailable') ? ' has-error' : '' }}">
                            <label for="scheduleAvailable" class="col-md-4 control-label">@lang('models.scheduleAvailable')</label>

                            <div class="col-md-6">
                                <textarea id="scheduleAvailable" cols="100" rows="2" maxlength="{{config('forms.scheduleAvailable')}}"
                                           class="form-control" name="scheduleAvailable" autofocus required>{{ old('scheduleAvailable') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('scheduleAvailable'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('scheduleAvailable') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="totalHours_div" class="form-group{{ $errors->has('totalHours') ? ' has-error' : '' }}">
                            <label for="totalHours" class="col-md-4 control-label">@lang('models.totalHours')</label>

                            <div class="col-md-6">
                                <textarea id="totalHours" cols="100" rows="1" maxlength="{{config('forms.proposal_totalHours')}}"
                                           class="form-control" name="totalHours" autofocus required>{{ old('totalHours') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('totalHours'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('totalHours') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="earliestStartDate_div" class="form-group{{ $errors->has('earliestStartDate') ? ' has-error' : '' }}">
                            <label for="earliestStartDate" class="col-md-4 control-label">@lang('models.earliestStartDate')</label>

                            <div class="col-md-6">
                                <textarea id="earliestStartDate" cols="100" rows="1" maxlength="{{config('forms.earliestStartDate')}}"
                                           class="form-control" name="earliestStartDate" autofocus required>{{ old('earliestStartDate') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('earliestStartDate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('earliestStartDate') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div id="latestEndDate_div" class="form-group{{ $errors->has('latestEndDate') ? ' has-error' : '' }}">
                            <label for="latestEndDate" class="col-md-4 control-label">@lang('models.latestEndDate')</label>

                            <div class="col-md-6">
                                <textarea id="latestEndDate" cols="100" rows="1" maxlength="{{config('forms.latestEndDate')}}"
                                           class="form-control" name="latestEndDate" autofocus required>{{ old('latestEndDate') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('latestEndDate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('latestEndDate') }}</strong>
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
@endif
@else

<div class="panel-group">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                            @lang('general.your_proposal')
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($proposal->student->user->urlAvatar))
                                <img src="{{url($proposal->student->user->urlAvatar)}}" class="media-object" style="width:60px">
                                @else
                                <img src="{{URL::asset('images/avatar.jpg')}}" class="media-object" style="width:60px">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a data-toggle="collapse" href="#collapseProposal">{{$proposal->student->user->getNameAndSurnames()}}</a>
                                @if($proposal->state == 1)
                                    <span class="label label-info">@lang('enums.proposal_state_1')</span>
                                @elseif($proposal->state == 2)
                                    <span class="label label-success">@lang('enums.proposal_state_2')</span>
                                @elseif($proposal->state == 3)
                                    <span class="label label-danger">@lang('enums.proposal_state_3')</span>
                                @elseif($proposal->state == 4)
                                    <span class="label label-success">@lang('enums.proposal_state_4')</span>
                                @elseif($proposal->state == 5)
                                    <span class="label label-danger">@lang('enums.proposal_state_5')</span>
                                @endif
                                </h4>
                                <p>
                                    <form>
                                        {{ csrf_field() }}
                                        <div class="btn-group">
                                            @if($proposal->state == 1)
                                            <button class="btn btn-warning" type="submit" formmethod="POST" formaction="{{route('removeProposal', ['id'=> $proposal->id])}}">@lang('general.remove')</button>
                                            @endif
                                            @if($proposal->state <= 2)
                                            <!-- Trigger the modal to accept the offer -->
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCancel">@lang('general.cancel')</button>
                                            @endif
                                            @if($proposal->state == 2)
                                            <!-- Trigger the modal to accept the offer -->
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAccept">@lang('general.accept')</button>
                                            @endif
                                        </div>
                                    </form>
                                </p>
                            </div>
                        </div>
                        </div>
                        <div id="collapseProposal" class="panel-collapse collapse">
                        <ul class="list-group">
                            <li class="list-group-item "><b>@lang('models.type'):</b> @lang('enums.proposal_type_' . $proposal->type)</li>
                            <li class="list-group-item"><b>@lang('models.description'):</b> {{$proposal->description}}</li>
                            <li class="list-group-item"><b>@lang('models.scheduleAvailable'):</b> {{$proposal->scheduleAvailable}}</li>
                            <li class="list-group-item"><b>@lang('models.totalHours'):</b> {{$proposal->totalHours}}</li>
                            <li class="list-group-item"><b>@lang('models.earliestStartDate'):</b> {{$proposal->earliestStartDate}}</li>
                            <li class="list-group-item"><b>@lang('models.latestEndDate'):</b> {{$proposal->latestEndDate}}</li>
                            <li class="list-group-item"><b>@lang('models.creationDate'):</b> {{$proposal->creationDate}}</li>
                        </ul>
                        </div>
                    </div>
                </div> 

@endif

@endsection


@if(!is_null($proposal))
<!-- Modal to accept offer-->
<div id="modalAccept" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('general.accept_practices')</h4>
      </div>
      <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('acceptProposal', ['id'=> $proposal->id]) }}">
                            {{ csrf_field() }}
                       
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                        @lang('general.accept')
                                </button>
                            </div>
                        </div>
                            
                        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('general.close')</button>
      </div>
    </div>

  </div>
</div>
@endif

@if(!is_null($proposal))
<!-- Modal to cancel proposal-->
<div id="modalCancel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('general.cancel_proposal')</h4>
      </div>
      <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('cancelProposal', ['id'=> $proposal->id]) }}">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-danger">
                                        @lang('general.cancel')
                                </button>
                            </div>
                        </div>
                            
                        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('general.close')</button>
      </div>
    </div>

  </div>
</div>
@endif
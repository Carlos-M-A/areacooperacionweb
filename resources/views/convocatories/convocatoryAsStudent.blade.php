@extends('convocatories.convocatory')


@section('convocatory_options')

@if($convocatory->state==1 && is_null($inscription))
    <div class="panel-footer">
        <form>
            {{ csrf_field() }}
                <button class="btn btn-warning" formmethod="POST" formaction="{{route('createInscription', ['id'=> $convocatory->id])}}"
                        data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.enroll_in_convocatory')"
                        >@lang('general.enroll')</button>
        </form>
    </div>
@endif

@endsection




@section('inscription')
@if(!is_null($inscription))
<div class="panel panel-default">
            <div class="panel-heading">
                <!-- Left-aligned -->
                        <div class="media">
                            @lang('general.your_inscription')
                            <div class="media-left">
                                @if(!is_null($inscription->student->user->urlAvatar))
                                <img src="{{url($inscription->student->user->urlAvatar)}}" class="media-object img-circle img-thumbnail" style="width:60px;height:60px;">
                                @else
                                <img src="{{URL::asset('images/avatar.jpg')}}" class="media-object img-circle img-thumbnail" style="width:60px;height:60px;">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a data-toggle="collapse" href="#collapseProposal">{{$inscription->student->user->getNameAndSurnames()}}</a>
                                @if($inscription->state == 1)
                                    <span class="label label-info">@lang('enums.inscription_state_1')</span>
                                @elseif($inscription->state == 2)
                                    <span class="label label-success">@lang('enums.inscription_state_2')</span>
                                @elseif($inscription->state == 3)
                                    <span class="label label-warning">@lang('enums.inscription_state_3')</span>
                                @elseif($inscription->state == 4)
                                    <span class="label label-danger">@lang('enums.inscription_state_4')</span>
                                @elseif($inscription->state == 5)
                                    <span class="label label-danger">@lang('enums.inscription_state_5')</span>
                                @endif
                                <span class="label label-info">{{$inscription->score}}</span></h4>
                                <p>
                                    
                                    <form>
                                        {{ csrf_field() }}
                                            @if($convocatory->state == 1)
                                            <button class="btn btn-danger" type="submit" formmethod="POST" formaction="{{route('removeInscription', ['id'=> $inscription->id])}}"
                                                    data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.remove_inscription')"
                                                    >@lang('general.remove')</button>
                                            @endif
                                            @if($inscription->state < 5 && $convocatory->state == 2)
                                            <button class="btn btn-danger" type="submit" formmethod="POST" formaction="{{route('cancelInscription', ['id'=> $inscription->id])}}"
                                                    data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.cancel_inscription')"
                                                    >@lang('general.cancel')</button>
                                            @endif
                                    </form>
                                    
                                </p>
                            </div>
                        </div>
                        </li>
            </div>
                <div class="text-center">
                    <a data-toggle="collapse" href="#collapseProposal"><span class="glyphicon glyphicon-menu-down" style="font-size: 20px;"></span></a>
                </div>
                <div id="collapseProposal" class="panel-collapse collapse">
                    <ul class="list-group">
                        <li class="list-group-item"><b>@lang('models.observations'):</b> {{$inscription->observations}}</li>
                    </ul>
                        
                    
                        
                </div>
    </div>

            
@endif
@endsection
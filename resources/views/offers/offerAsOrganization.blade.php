@extends('offers.offer')

@section('offer_options')
@if($offer->open)
<div class="panel-footer">
    <form>
        {{ csrf_field() }}
            <button class="btn btn-primary" formmethod="GET" formaction="{{route('showEditOffer', ['id'=> $offer->id])}}">@lang('general.edit')</button>
            <button class="btn btn-warning" formmethod="POST" formaction="{{route('closeOffer', ['id'=> $offer->id])}}"
                    data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.close_offer')"
                    >@lang('general.close')</button>
    </form>
</div>
@endif
@endsection

@section('offer_proposals')

<div class="panel panel-info">
    <div class="panel-heading">
        Proposals
        <ul class="nav nav-pills">
            @if(is_null(old('stateOfProposals')))
                <li class="active"><a href="{{ route('offer', ['id'=> $offer->id, 'stateOfProposals' => 1]) }}">@lang('general.not_evaluated')<span class="badge">{{$offer->getAmountOfNotEvaluatedProposals()}}</span></a></li>
            @else
                <li class="{{old('stateOfProposals')==1 ? 'active' : ''}}"><a href="{{ route('offer', ['id'=> $offer->id, 'stateOfProposals' => 1]) }}">@lang('general.not_evaluated')<span class="badge">{{$offer->getAmountOfNotEvaluatedProposals()}}</span></a></li>
            @endif
                <li class="{{old('stateOfProposals')==2 ? 'active' : ''}}"><a href="{{ route('offer', ['id'=> $offer->id, 'stateOfProposals' => 2]) }}">@lang('general.approved')<span class="badge">{{$offer->getAmountOfApprovedProposals()}}</span></a></li>
                <li class="{{old('stateOfProposals')==3 ? 'active' : ''}}"><a href="{{ route('offer', ['id'=> $offer->id, 'stateOfProposals' => 3]) }}">@lang('general.rejected')<span class="badge">{{$offer->getAmountOfRejectedProposals()}}</span></a></li>
                <li class="{{old('stateOfProposals')==5 ? 'active' : ''}}"><a href="{{ route('offer', ['id'=> $offer->id, 'stateOfProposals' => 5]) }}">@lang('general.cancelled')<span class="badge">{{$offer->getAmountOfCancelledProposals()}}</span></a></li>
                <li class="{{old('stateOfProposals')==4 ? 'active' : ''}}"><a href="{{ route('offer', ['id'=> $offer->id, 'stateOfProposals' => 4]) }}">@lang('general.chosen')<span class="badge">{{$offer->getAmountOfAcceptedProposals()}}</span></a></li>
                    </ul>
    </div>
    <div class="panel-body">
        
        @foreach($proposals as $proposal)
        @php
            $user = App\User::find($proposal->student_id);
        @endphp
                <div class="panel-group">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                <!-- Left-aligned -->
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($user->urlAvatar))
                                <img src="{{url($user->urlAvatar)}}" class="media-object img-circle img-thumbnail" style="width:60px;height:60px;">
                                @else
                                <img src="{{URL::asset('images/avatar.jpg')}}" class="media-object img-circle img-thumbnail" style="width:60px;height:60px;">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a data-toggle="collapse" href="#{{'collapse'.$user->id}}">{{$user->getNameAndSurnames()}}</a>
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
                                            <button class="btn btn-info" type="submit" formmethod="GET" formaction="{{route('user', ['id'=> $user->id])}}">@lang('general.view')</button>
                                        @if($offer->open)
                                        @if($proposal->state == 1 || $proposal->state == 3)
                                        <button class="btn btn-success" type="submit" formmethod="POST" formaction="{{route('approveProposal', ['id'=> $proposal->id])}}">@lang('general.approve')</button>
                                        @endif
                                        @if($proposal->state <= 2)
                                        <button class="btn btn-danger"  type="submit" formmethod="POST" formaction="{{route('rejectProposal', ['id'=> $proposal->id])}}">@lang('general.reject')</button>
                                        @endif
                                        @endif
                                    </form>
                                </p>
                            </div>
                        </div>
            </div>
                    <div id="{{'collapse'.$user->id}}" class="panel-collapse collapse">
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
        @endforeach
    </div>
    <div class="panel-footer">
        {{ $proposals->appends(['stateOfProposals' => old('stateOfProposals')])->links() }}
    </div>
</div>
@endsection


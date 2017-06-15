@extends('offers.offer')

@section('offer_options')
@if($offer->open)
<div class="panel-footer">
    <form>
        {{ csrf_field() }}
        <div class="btn-group">
            <button class="btn btn-primary" formmethod="GET" formaction="{{route('showEditOffer', ['id'=> $offer->id])}}">Edit</button>
            <button class="btn btn-warning" formmethod="POST" formaction="{{route('closeOffer', ['id'=> $offer->id])}}">Close</button>
        </div>
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
                <li class="active"><a href="{{ route('offer', ['id'=> $offer->id, 'stateOfProposals' => 1]) }}">news<span class="badge">{{$offer->getAmountOfNotEvaluatedProposals()}}</span></a></li>
            @else
                <li class="{{old('stateOfProposals')==1 ? 'active' : ''}}"><a href="{{ route('offer', ['id'=> $offer->id, 'stateOfProposals' => 1]) }}">news<span class="badge">{{$offer->getAmountOfNotEvaluatedProposals()}}</span></a></li>
            @endif
                <li class="{{old('stateOfProposals')==2 ? 'active' : ''}}"><a href="{{ route('offer', ['id'=> $offer->id, 'stateOfProposals' => 2]) }}">Approved<span class="badge">{{$offer->getAmountOfApprovedProposals()}}</span></a></li>
                <li class="{{old('stateOfProposals')==3 ? 'active' : ''}}"><a href="{{ route('offer', ['id'=> $offer->id, 'stateOfProposals' => 3]) }}">Rejected<span class="badge">{{$offer->getAmountOfRejectedProposals()}}</span></a></li>
                <li class="{{old('stateOfProposals')==5 ? 'active' : ''}}"><a href="{{ route('offer', ['id'=> $offer->id, 'stateOfProposals' => 5]) }}">Cancelled<span class="badge">{{$offer->getAmountOfCancelledProposals()}}</span></a></li>
                <li class="{{old('stateOfProposals')==4 ? 'active' : ''}}"><a href="{{ route('offer', ['id'=> $offer->id, 'stateOfProposals' => 4]) }}">Students winners<span class="badge">{{$offer->getAmountOfAcceptedProposals()}}</span></a></li>
                    </ul>
    </div>
    <div class="panel-body">
        
         @foreach($proposals as $proposal)
                <div class="panel-group">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                <!-- Left-aligned -->
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($proposal->student->user->urlAvatar))
                                <img src="{{URL::asset($proposal->student->user->urlAvatar)}}" class="media-object" style="width:60px">
                                @else
                                <img src="{{url('images/avatar.jpg')}}" class="media-object" style="width:60px">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a data-toggle="collapse" href="#{{'collapse'.$proposal->student->id}}">{{$proposal->student->user->getNameAndSurnames()}}</a>
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
                                            <button class="btn btn-info" type="submit" formmethod="GET" formaction="{{route('user', ['id'=> $proposal->student->user->id])}}">@lang('view')</button>
                                        @if($offer->open)
                                        @if($proposal->state == 1 || $proposal->state == 3)
                                        <button class="btn btn-success" type="submit" formmethod="POST" formaction="{{route('approveProposal', ['id'=> $proposal->id])}}">Approve</button>
                                        @endif
                                        @if($proposal->state <= 2)
                                        <button class="btn btn-danger"  type="submit" formmethod="POST" formaction="{{route('rejectProposal', ['id'=> $proposal->id])}}">Reject</button>
                                        @endif
                                        @endif
                                        </div>
                                    </form>
                                </p>
                            </div>
                        </div>
            </div>
                    <div id="{{'collapse'.$proposal->student->id}}" class="panel-collapse collapse">
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


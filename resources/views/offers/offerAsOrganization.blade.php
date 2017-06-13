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
        <ul class="nav nav-pills">
                        <li class="{{old('stateOfProposals')==1 ? 'active' : ''}}"><a href="{{ route('offer', ['id'=> $offer->id, 'stateOfProposals' => 1]) }}">news<span class="badge">{{$offer->getAmountOfNotEvaluatedProposals()}}</span></a></li>
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
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#{{'collapse'.$proposal->student->id}}">{{$proposal->student->user->getNameAndSurnames()}}</a>
                            </h4>
                        </div>
                    <div id="{{'collapse'.$proposal->student->id}}" class="panel-collapse collapse">
                    <ul class="list-group">
                        <li class="list-group-item ">type: {{$proposal->type}}</li>
                        <li class="list-group-item">description: {{$proposal->description}}</li>
                        <li class="list-group-item">scheduleAvailable: {{$proposal->scheduleAvailable}}</li>
                        <li class="list-group-item">totalHours: {{$proposal->totalHours}}</li>
                        <li class="list-group-item">earliestStartDate: {{$proposal->earliestStartDate}}</li>
                        <li class="list-group-item">latestEndDate: {{$proposal->latestEndDate}}</li>
                        <li class="list-group-item">state: {{$proposal->state}}</li>
                        <li class="list-group-item">creationDate: {{$proposal->creationDate}}</li>
                        <li class="list-group-item">skills: {{$proposal->student->skills}}</li>
                        <li class="list-group-item">areasOfInterest: {{$proposal->student->areasOfInterest}}</li>
                        <li class="list-group-item">study: {{$proposal->student->study->name}}</li>
                        <li class="list-group-item">urlCurriculum: {{$proposal->student->urlCurriculum}}</li>
                        <li class="list-group-item">phone: {{$proposal->student->user->phone}}</li>
                        <li class="list-group-item">email: {{$proposal->student->user->email}}</li>
                    </ul>
                    </div>
                    @if($offer->open)
                    <div class="panel-footer">
                        
                            <form>
                                {{ csrf_field() }}
                                <div class="btn-group">
                                    @if($proposal->state == 1 || $proposal->state == 3)
                                    <button class="btn btn-success" type="submit" formmethod="POST" formaction="{{route('approveProposal', ['id'=> $proposal->id])}}">Approve</button>
                                    @endif
                                    @if($proposal->state <= 2)
                                    <button class="btn btn-danger"  type="submit" formmethod="POST" formaction="{{route('rejectProposal', ['id'=> $proposal->id])}}">Reject</button>
                                    @endif
                                </div>
                            </form>
                    </div>
                    @endif
                    </div>
                </div> 
        @endforeach
    </div>
    <div class="panel-footer">
        {{ $proposals->appends(['stateOfProposals' => old('stateOfProposals')])->links() }}
    </div>
</div>
@endsection


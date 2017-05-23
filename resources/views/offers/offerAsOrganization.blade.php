@extends('offers.offer')

@section('offer_options')
<div class="btn-group">
    <button class="btn btn-warning" onclick="event.preventDefault(); document.getElementById('close_form').submit();">Close</button>
    <button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('edit_form').submit();">Edit</button>
    <button class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('remove_form').submit();">Remove</button>
</div>
<form id="close_form" action="{{route('closeOffer', ['id'=> $offer->id])}}" method="POST">
    {{ csrf_field() }}
    </form>
<form id="edit_form" action="{{route('showEditOffer', ['id'=> $offer->id])}}" method="GET">
    </form>
<form id="remove_form" action="{{route('removeOffer', ['id'=> $offer->id])}}" method="POST">
    {{ csrf_field() }}
    </form>

@endsection

@section('offer_proposals')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapseProjects">Projects</a>
                            </h4>
    </div>
    <div id="collapseProjects" class="panel-collapse collapse">
        
         @foreach($offer->proposals as $proposal)
            @if($proposal->state == 4)
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
                    </ul>
                    </div>
                    </div>
                </div> 
            @endif
        @endforeach
    </div>
</div>

<div class="panel panel-success">
    <div class="panel-heading">
        <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapseApprovedProposals">Approved Proposals</a>
                            </h4>
    </div>
    <div id="collapseApprovedProposals" class="panel-collapse collapse">
        
         @foreach($offer->proposals as $proposal)
            @if($proposal->state == 2)
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
                    </ul>
                    </div>
                    <div class="panel-footer">
                        <form>
                                {{ csrf_field() }}
                                <div class="btn-group">
                                    <button class="btn btn-danger"  type="submit" formmethod="POST" formaction="{{route('rejectProposal', ['id'=> $proposal->id])}}">Reject</button>
                                </div>
                            </form>
                    </div>
                    </div>
                </div> 
            @endif
        @endforeach
    </div>
</div>

<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapseNewProposals">New Proposals</a>
                            </h4>
    </div>
    <div id="collapseNewProposals" class="panel-collapse collapse">
        
         @foreach($offer->proposals as $proposal)
            @if($proposal->state == 1)
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
                    <div class="panel-footer">
                        
                            <form>
                                {{ csrf_field() }}
                                <div class="btn-group">
                                    <button class="btn btn-success" type="submit" formmethod="POST" formaction="{{route('approveProposal', ['id'=> $proposal->id])}}">Approve</button>
                                    <button class="btn btn-danger"  type="submit" formmethod="POST" formaction="{{route('rejectProposal', ['id'=> $proposal->id])}}">Reject</button>
                                </div>
                            </form>
                    </div>
                    </div>
                </div> 
            @endif
        @endforeach
    </div>
</div>

<div class="panel panel-danger">
    <div class="panel-heading">
        <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapseRejectedProposals">Rejected Proposals</a>
                            </h4>
    </div>
    <div id="collapseRejectedProposals" class="panel-collapse collapse">
        
         @foreach($offer->proposals as $proposal)
            @if($proposal->state == 3)
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
                    </ul>
                    </div>
                    <div class="panel-footer">
                        <form>
                                {{ csrf_field() }}
                                <div class="btn-group">
                                    <button class="btn btn-success" type="submit" formmethod="POST" formaction="{{route('approveProposal', ['id'=> $proposal->id])}}">Approve</button>
                                </div>
                            </form>
                    </div>
                    </div>
                </div> 
            @endif
        @endforeach
    </div>
</div>

<div class="panel panel-danger">
    <div class="panel-heading">
        <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapseCancelledProposals">Cancelled Proposals</a>
                            </h4>
    </div>
    <div id="collapseCancelledProposals" class="panel-collapse collapse">
        
         @foreach($offer->proposals as $proposal)
            @if($proposal->state == 5)
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
                    </ul>
                    </div>
                    </div>
                </div> 
            @endif
        @endforeach
    </div>
</div>

@endsection


@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <!-- Left-aligned -->
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($offer->organization->user->urlAvatar))
                                <img src="{{url($offer->organization->user->urlAvatar)}}" class="media-object" style="width:60px">
                                @else
                                <img src="{{URL::asset('images/avatar.jpg')}}" class="media-object" style="width:60px">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a data-toggle="collapse" href="#collapseOffer">{{$offer->title}}</a>
                                @if($offer->open)
                                    <span class="label label-success">@lang('general.open')</span>
                                @else
                                    <span class="label label-danger">@lang('general.closed')</span>
                                @endif
                                </h4>
                                <p><a href='{{route('user', ['id' => $offer->organization->id])}}'>{{$offer->organization->user->name}}</a></p>
                            </div>
                        </div>
                </div>
                
                <div class="">
                    <ul class="nav nav-pills">
                        <li class=""><a>@lang('models.deadline')<span class="badge">{{$offer->deadline}}</span></a></li>
                        <li class=""><a>@lang('models.places')<span class="badge">{{$offer->places}}</span></a></li>
                        <li class=""><a>@lang('general.places_occupied')<span class="badge">{{$offer->getAmountOfAcceptedProposals()}}</span></a></li>
                        <li class=""><a>@lang('general.proposals')<span class="badge">{{count($offer->proposals)}}</span></a></li>
                        </ul>
                </div>
                
                    <div id="collapseOffer" class="panel-collapse collapse">
                        <ul class="list-group">
                            @if($offer->managedByArea)
                            <li class="list-group-item"><b>@lang('models.managedByArea'):</b> <a href='{{route('user', ['id' => 2])}}'>{{config('app.name', 'Area of Cooperation')}}</a></li>
                            @endif
                            <li class="list-group-item"><b>@lang('models.scope'):</b> {{$offer->scope}}</li>
                            <li class="list-group-item"><b>@lang('models.description'):</b> {{$offer->description}}</li>
                            <li class="list-group-item"><b>@lang('models.requeriments'):</b> {{$offer->requeriments}}</li>
                            <li class="list-group-item"><b>@lang('models.workplan'):</b> {{$offer->workplan}}</li>
                            <li class="list-group-item"><b>@lang('models.schedule'):</b> {{$offer->schedule}}</li>
                            <li class="list-group-item"><b>@lang('models.totalHours'):</b> {{$offer->totalHours}}</li>
                            <li class="list-group-item"><b>@lang('models.possibleStartDates'):</b> {{$offer->possibleStartDates}}</li>
                            <li class="list-group-item"><b>@lang('models.possibleEndDates'):</b> {{$offer->possibleEndDates}}</li>
                            <li class="list-group-item"><b>@lang('models.monetaryHelp'):</b> {{$offer->monetaryHelp}}</li>
                            <li class="list-group-item"><b>@lang('models.personInCharge'):</b> {{$offer->personInCharge}}</li>
                            <li class="list-group-item"><b>@lang('models.createdDate'):</b> {{$offer->createdDate}}</li>
                            @if($offer->isOfferOfConvocatory)
                            <li class="list-group-item"><b>@lang('models.housing'):</b> {{$offer->offerOfConvocatory->housing}}</li>
                            <li class="list-group-item"><b>@lang('models.costs'):</b> {{$offer->offerOfConvocatory->costs}}</li>
                            <li class="list-group-item"><b>@lang('models.convocatory'):</b> {{$offer->offerOfConvocatory->convocatory->title}}</li>
                            @endif
                        </ul>
                    </div>
                
                     @yield('offer_options')
                
            </div>
            @yield('offer_proposals')
                                
            @yield('student_proposal')
        </div>
    </div>
</div>


@endsection

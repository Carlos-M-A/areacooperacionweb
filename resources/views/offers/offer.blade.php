@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapseOffer">{{$offer->title}}</a>
                    </h4>
                </div>
                    <div id="collapseOffer" class="panel-collapse collapse">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>field</th>
                                    <th>data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>organization_id</td>
                                    <td><a href='{{route('organization', ['id' => $offer->organization_id])}}'>{{$offer->organization->user->name}}</a></td>
                                </tr>
                                <tr>
                                    <td>managedByArea</td>
                                    <td>{{$offer->managedByArea}}</td>
                                </tr>
                                <tr>
                                    <td>title</td>
                                    <td>{{$offer->title}}</td>
                                </tr>
                                <tr>
                                    <td>scope</td>
                                    <td>{{$offer->scope}}</td>
                                </tr>
                                <tr>
                                    <td>description</td>
                                    <td>{{$offer->description}}</td>
                                </tr>
                                <tr>
                                    <td>requeriments</td>
                                    <td>{{$offer->requeriments}}</td>
                                </tr>
                                <tr>
                                    <td>workplan</td>
                                    <td>{{$offer->workplan}}</td>
                                </tr>
                                <tr>
                                    <td>schedule</td>
                                    <td>{{$offer->schedule}}</td>
                                </tr>
                                <tr>
                                    <td>totalHours</td>
                                    <td>{{$offer->totalHours}}</td>
                                </tr>
                                <tr>
                                    <td>possibleStartDates</td>
                                    <td>{{$offer->possibleStartDates}}</td>
                                <tr>
                                    <td>possibleEndDates</td>
                                    <td>{{$offer->possibleEndDates}}</td>
                                </tr>
                                <tr>
                                    <td>places</td>
                                    <td>{{$offer->places}}</td>
                                </tr>
                                <tr>
                                    <td>placesOccupied</td>
                                    <td>{{$offer->getAmountOfAcceptedProposals()}}</td>
                                </tr>
                                <tr>
                                    <td>monetaryHelp</td>
                                    <td>{{$offer->monetaryHelp}}</td>
                                </tr>
                                <tr>
                                    <td>personInCharge</td>
                                    <td>{{$offer->personInCharge}}</td>
                                </tr>
                                <tr>
                                    <td>createdDate</td>
                                    <td>{{$offer->createdDate}}</td>
                                </tr>
                                <tr>
                                    <td>deadLine</td>
                                    <td>{{$offer->deadline}}</td>
                                </tr>
                                <tr>
                                    <td>open</td>
                                    <td>{{$offer->open}}</td>
                                </tr>
                                <tr>
                                    <td>proposal amount</td>
                                    <td>{{count($offer->proposals)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                     @yield('offer_options')
                
            </div>
            @yield('offer_proposals')
                                
            @yield('student_proposal')
        </div>
    </div>
</div>


@endsection

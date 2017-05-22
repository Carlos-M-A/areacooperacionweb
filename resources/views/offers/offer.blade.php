@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Offer data</div>
                <div class="panel-body">
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
                                    <td>{{$offer->organization_id}}</td>
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
                                    <td>{{$offer->possibleStartDates}}</td>º
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
                                    <td>{{$offer->placesOccupied}}</td>
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
                                
                                @yield('offer_proposals')
                                
                                @yield('student_proposal')

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

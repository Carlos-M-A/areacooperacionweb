@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">@lang('models.organization')</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{$organization->user->name}}</td>
                                </tr>

                                <tr>
                                    <td>Social name</td>
                                    <td>{{$organization->socialName}}</td>
                                </tr>

                                <tr>
                                    <td>Email</td>
                                    <td>{{$organization->user->email}}</td>
                                </tr>
                                <tr>
                                    <td>Phone number</td>
                                    <td>{{$organization->user->phone}}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{{$organization->description}}</td>
                                </tr>
                                <tr>
                                    <td>URL logo</td>
                                    <td>{{$organization->urlLogoImage}}</td>
                                </tr>
                                <tr>
                                    <td>headquarters location</td>
                                    <td>{{$organization->headquartersLocation}}</td>
                                </tr>
                                <tr>
                                    <td>Web</td>
                                    <td>{{$organization->web}}</td>
                                </tr>
                                <tr>
                                    <td> Links with nearby entities</td>
                                    <td>{{$organization->linksWithNearbyEntities}}</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">Offers</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Managed by area</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($organization->offers as $offer)
                                <tr>
                                    <td><a href="{{route('offer', ['id'=> $offer->id])}}" >{{$offer->title}}</a></td>
                                    <td>{{$offer->managedByArea}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>
</div>
@endsection

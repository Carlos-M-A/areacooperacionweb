@extends('layouts.app')

@section('content')

@php
    $user = Auth::user();
@endphp

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Offers
                    @if($user->role == 4 || $user->role == 5)
                    <ul class="nav nav-pills">
                        <li class=""><a href="{{ route('myOffers') }}">myOffers</a></li>
                        <li class=""><a href="{{ route('myOpenOffers') }}">myOpenOffers</a></li>
                        <li class=""><a href="{{ route('myClosedOffers') }}">myClosedOffers</a></li>
                    </ul>
                    @elseif($user->role == 1)
                    <ul class="nav nav-pills">
                        <li class=""><a href="{{ route('newOffers') }}">newOffers</a></li>
                        <li class=""><a href="{{ route('offersWithProposal') }}">offersWithProposal</a></li>
                        <li class=""><a href="{{ route('approvedProposals') }}">approvedProposals</a></li>
                        <li class=""><a href="{{ route('acceptedProposals') }}">acceptedProposals</a></li>
                    </ul>
                    @endif
                </div>
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
                                
                                @foreach($offers as $offer)
                                <tr>
                                    <td><a href="{{route('offer', ['id'=> $offer->id])}}" >{{$offer->title}}</a></td>
                                    <td>{{$offer->managedByArea}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    {{ $offers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

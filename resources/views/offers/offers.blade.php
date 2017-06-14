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
                    @if($user->role == 1)
                    <ul class="nav nav-pills">
                        <li class=""><a href="{{ route('newOffers') }}">newOffers</a></li>
                        <li class=""><a href="{{ route('offersWithProposal') }}">offersWithProposal</a></li>
                        <li class=""><a href="{{ route('approvedProposals') }}">approvedProposals</a></li>
                        <li class=""><a href="{{ route('acceptedProposals') }}">acceptedProposals</a></li>
                    </ul>
                    @elseif($user->role == 4 || $user->role == 5)
                    <ul class="nav nav-pills">
                        <li class=""><a href="{{ route('myOffers') }}">myOffers</a></li>
                        <li class=""><a href="{{ route('myOpenOffers') }}">myOpenOffers</a></li>
                        <li class=""><a href="{{ route('myClosedOffers') }}">myClosedOffers</a></li>
                    </ul>
                    @endif
                </div>
                <div class="panel-body">

                    <ul class="list-group">
                        @foreach($offers as $offer)
                        <li class="list-group-item">
                        <!-- Left-aligned -->
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($offer->organization->user->urlAvatar))
                                <img src="{{URL::asset($offer->organization->user->urlAvatar)}}" class="media-object" style="width:60px">
                                @else
                                <img src="{{url('images/avatar.jpg')}}" class="media-object" style="width:60px">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="{{route('offer', ['id'=> $offer->id])}}" >{{$offer->title}}</a>
                                @if($offer->open)
                                    <span class="label label-success">@lang('general.open')</span>
                                @else
                                    <span class="label label-danger">@lang('general.closed')</span>
                                @endif
                                </h4>
                                <p>{{$offer->organization->user->name}}</p>
                            </div>
                        </div>
                        </li>
                        @endforeach
                    </ul> 

                </div>
                <div class="panel-footer">
                    {{ $offers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

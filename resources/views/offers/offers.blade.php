@extends('layouts.app')

@section('content')

@php
    $user = Auth::user();
@endphp

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.navigationBar', ['active' => 1])
            <div class="panel panel-info">
                <div class="panel-heading">
                    @lang('general.offers')
                    @if($user->role == 1)
                    <ul class="nav nav-pills">
                        <li class="{{($ask == 1) ? 'active' : ''}}"><a href="{{ route('newOffers') }}">@lang('general.new_offers')</a></li>
                        <li class="{{($ask == 2) ? 'active' : ''}}"><a href="{{ route('offersWithProposal') }}">@lang('general.my_proposals')</a></li>
                        <li class="{{($ask == 3) ? 'active' : ''}}"><a href="{{ route('approvedProposals') }}">@lang('general.approved_proposals')</a></li>
                        <li class="{{($ask == 4) ? 'active' : ''}}"><a href="{{ route('acceptedProposals') }}">@lang('general.my_practices')</a></li>
                    </ul>
                    @elseif($user->role == 4 || $user->role == 5)
                    <ul class="nav nav-pills">
                        <li class="{{($ask == 5) ? 'active' : ''}}"><a href="{{ route('myOffers') }}">@lang('general.my_offers')</a></li>
                        <li class="{{($ask == 6) ? 'active' : ''}}"><a href="{{ route('myOpenOffers') }}">@lang('general.my_open_offers')</a></li>
                        <li class="{{($ask == 7) ? 'active' : ''}}"><a href="{{ route('myClosedOffers') }}">@lang('general.my_closed_offers')</a></li>
                        <li class=""><a href="{{ route('showCreateOffer') }}">@lang('general.create_offer')</a></li>
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
                                <img src="{{url($offer->organization->user->urlAvatar)}}" class="media-object img-circle img-thumbnail" style="width:60px;height:60px;">
                                @else
                                <img src="{{URL::asset('images/avatar.jpg')}}" class="media-object img-circle img-thumbnail" style="width:60px;height:60px;">
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
                                @if($offer->isOfferOfConvocatory)
                                <span class="badge">{{$offer->offerOfConvocatory->convocatory->title}}</span>
                                @endif
                                
                            </div>
                        </div>
                        </li>
                        @endforeach
                    </ul> 
                    {{ $offers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

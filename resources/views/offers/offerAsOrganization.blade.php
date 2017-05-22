@extends('offers.offer')

@section('offer_options')
<a href="{{route('openOffers')}}">Close</a>
<a href="{{route('showEditOffer', ['id'=> $offer->id])}}">Edit</a>
<a href="{{route('openOffers')}}">Delete</a>
@endsection

@section('offer_proposals')
aaaaaaaaa
@endsection
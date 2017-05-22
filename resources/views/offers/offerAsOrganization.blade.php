@extends('offers.offer')

@section('offer_options')

<form action="{{route('closeOffer', ['id'=> $offer->id])}}" method="POST">
    {{ csrf_field() }}
<a href="#" onclick="this.parentNode.submit()">Close</a>
</form>
<a href="{{route('showEditOffer', ['id'=> $offer->id])}}">Edit</a>
<form action="{{route('removeOffer', ['id'=> $offer->id])}}" method="POST">
    {{ csrf_field() }}
<a href="#" onclick="this.parentNode.submit()">Remove</a>
</form>
@endsection

@section('offer_proposals')

@endsection
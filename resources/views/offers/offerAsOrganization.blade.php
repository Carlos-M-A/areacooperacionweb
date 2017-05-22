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
<div class="panel panel-default">
                <div class="panel-heading">Proposals</div>
                <div class="panel-body">
                    
                                @foreach($offer->proposals as $proposal)
                                <ul class="list-group">
                                    <li class="list-group-item"><a href="{{route('user', ['id'=> $proposal->student_id])}}" >{{$proposal->student->user->getNameAndSurnames()}}</a></li>
                                    <li class="list-group-item">{{$proposal->type}}</li>
                                </ul>
                                @endforeach

                </div>
            </div>
@endsection
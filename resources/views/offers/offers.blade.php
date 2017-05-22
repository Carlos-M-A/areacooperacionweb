@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
            </div>
        </div>
    </div>
</div>


@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Options cooperation area</div>

                <div class="panel-body">
                    <p>
                    <a href="{{ route('showCreateOffer') }}"> Create offer</a>
                    <p>
                    <a href="{{ route('openOffers') }}"> My open offers</a>
                    <p>
                    <a href="{{ route('closedOffers') }}"> My closed offers</a>
                    <p>
                    <a href="{{ route('showCreateConvocatory') }}"> Create convocatory</a>
                    <p>
                    <a href="{{ route('convocatories') }}"> Convocatories</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


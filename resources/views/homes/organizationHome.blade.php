@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Organization Options</div>

                <div class="panel-body">
                    
                    <p>
                    <a href="{{ route('showCreateOffer') }}"> Create offer</a>
                    <p>
                    <a href="{{ route('myOpenOffers') }}"> My open offers</a>
                    <p>
                    <a href="{{ route('myClosedOffers') }}"> My closed offers</a>
                    <p>
                    <a href="{{ route('myOffers') }}"> myOffers</a>
                    <p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

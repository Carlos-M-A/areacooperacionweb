@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Organization Options</div>

                <div class="panel-body">
                    <button type="button" class="btn btn-primary btn-block"
                            onclick="event.preventDefault(); document.getElementById('createOffer_form').submit();">
                        Create offer</button>
                    <form id="createOffer_form" action="{{ route('showCreateOffer') }}" method="GET" style="display: none;">
                                        </form>
                    <button type="button" class="btn btn-primary btn-block"
                            onclick="event.preventDefault(); document.getElementById('myOffers_form').submit();">
                        My offers</button>
                    <form id="myOffers_form" action="{{ route('showCreateOffer') }}" method="GET" style="display: none;">
                                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

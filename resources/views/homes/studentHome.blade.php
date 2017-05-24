@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Opciones Estudiante</div>

                <div class="panel-body">
                    
                    <p>
                    <a href="{{ route('newOffers') }}">New offers</a>
                    <p>
                    <a href="{{ route('notEvaluatedProposals') }}">Offers with not evaluated proposals</a>
                    <p>
                    <a href="{{ route('approvedProposals') }}">Offers with approved proposals</a>
                    <p>
                    <a href="{{ route('rejectedProposals') }}">Offers with rejected proposals</a>
                    <p>
                    <a href="{{ route('cancelledProposals') }}">Offers with cancelled proposals</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

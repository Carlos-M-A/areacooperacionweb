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
                    <a href="{{ route('offersWithProposal') }}">offersWithProposal</a>
                    <p>
                    <p>
                    <a href="{{ route('myProjects')}}">My projects</a>
                    <p>
                    <a href="{{ route('openProjects') }}">openProjects</a>
                    <p>
                    <a href="{{ route('acceptedProposals') }}">acceptedProposals</a>
                    <p>
                    <a href="{{ route('convocatories') }}"> Convocatories</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

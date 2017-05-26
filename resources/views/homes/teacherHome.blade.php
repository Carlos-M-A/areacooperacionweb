@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Opciones Docente</div>

                <div class="panel-body">
                    <p>
                    <a href="{{ route('newProjects') }}">newProjects</a>
                    <p>
                    <a href="{{ route('myTutoredProjects') }}">myTutoredProjects</a>
                    <p>
                    <a href="{{ route('myTutelageProposals') }}">myTutelageProposals</a>
                    <p>
                    <a href="{{ route('myTutelageProposalsNotChosen') }}">myTutelageProposalsNotChosen</a>
                    <p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

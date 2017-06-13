@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Offers management</div>

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
                    <a href="{{ route('showCreateConvocatory') }}"> Create convocatory</a>
                    <p>
                    <a href="{{ route('convocatories') }}"> Convocatories</a>
                </div>
            </div>
            
            
            <div class="panel panel-default">
                <div class="panel-heading">Project management</div>

                <div class="panel-body">
                    <p>
                    <a href="{{ route('finishedProjects') }}"> All projects</a>
                    <p>
                    <a href="{{ route('showCreateProject') }}"> Create project</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


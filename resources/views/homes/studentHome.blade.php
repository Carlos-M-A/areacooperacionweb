@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Opciones Estudiante</div>

                <div class="panel-body">
                    
                    <p>
                    <a href="{{ route('newOffers') }}">@lang('general.offers')</a>
                    <p>
                    <a href="{{ route('acceptedProposals') }}">@lang('general.my_practices')</a>
                    <p>
                    <a href="{{ route('proposedProjects') }}">@lang('general.projects')</a>
                    <p>
                    <a href="{{ route('convocatories') }}"> @lang('general.convocatories')</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

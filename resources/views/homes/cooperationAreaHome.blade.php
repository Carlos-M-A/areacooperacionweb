@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Offers management</div>

                <div class="panel-body">
                    <p>
                    <a href="{{ route('showCreateOffer') }}"> @lang('general.create_offer')</a>
                    <p>
                    <a href="{{ route('myOffers') }}"> @lang('general.my_offers')</a>
                    <p>
                    <a href="{{ route('showCreateConvocatory') }}">@lang('general.create_convocatory')</a>
                    <p>
                    <a href="{{ route('convocatories') }}">@lang('general.convocatories')</a>
                </div>
            </div>
            
            
            <div class="panel panel-default">
                <div class="panel-heading">Project management</div>

                <div class="panel-body">
                    <p>
                    <a href="{{ route('finishedProjects') }}"> @lang('general.finished_projects')</a>
                    <p>
                    <a href="{{ route('showCreateProject') }}"> @lang('general.create_project')</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


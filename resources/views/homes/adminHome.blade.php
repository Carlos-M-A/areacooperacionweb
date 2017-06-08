@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users management</div>

                <div class="panel-body">
                    <p>
                    <a href="{{ route('registrationRequests') }}"> Register requests</a>
                    <p>
                    <a href="{{ route('searchUsers', ['role' => 0]) }}"> Users</a>
                    <p>
                    <a href="{{ route('roleChanges') }}"> Role changes</a>
                    <p>
                    <a href="{{ route('showCreateOrganization') }}"> Create organization</a>
                    <p>
                    <a href="{{ route('observatory') }}"> The observatory</a>
                    
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">Configuration management</div>

                <div class="panel-body">
                    <p>
                    <a href="{{ route('searchStudies', ['branch' => 0]) }}"> Studies</a>
                    <p>
                    <a href="{{ route('showCreateStudy') }}"> @lang('general.create_study')</a>
                    <p>
                    <a href="{{ route('searchFaculties') }}"> Faculties</a>
                    <p>
                    <a href="{{ route('showCreateFaculty') }}"> @lang('general.create_faculty')</a>
                    <p>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Project management</div>

                <div class="panel-body">
                    <p>
                    <a href="{{ route('convocatories') }}"> Projects</a>
                    <p>
                    <a href="{{ route('convocatories') }}"> Create project</a>
                </div>
            </div>
        </div>
    </div>
</div>
   

@endsection

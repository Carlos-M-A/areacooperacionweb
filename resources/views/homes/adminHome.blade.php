@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users management</div>

                <div class="panel-body">
                    <p>
                    <a href="{{ route('registrationRequests') }}">@lang('general.registration_requests')</a>
                    <p>
                    <a href="{{ route('searchUsers', ['role' => 0]) }}">@lang('general.users')</a>
                    <p>
                    <a href="{{ route('roleChanges') }}">@lang('general.role_change_requests')</a>
                    <p>
                    <a href="{{ route('showCreateOrganization') }}">@lang('general.register_organization')</a>
                    <p>
                    <a href="{{ route('observatory', ['ask' => 1]) }}">@lang('general.the_observatory')</a>
                    
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">Configuration management</div>

                <div class="panel-body">
                    <p>
                    <a href="{{ route('searchStudies', ['branch' => 0]) }}"> @lang('general.studies')</a>
                    <p>
                    <a href="{{ route('showCreateStudy') }}"> @lang('general.create_study')</a>
                    <p>
                    <a href="{{ route('searchCampuses') }}"> @lang('general.campuses')</a>
                    <p>
                    <a href="{{ route('showCreateCampus') }}"> @lang('general.create_campus')</a>
                    <p>
                </div>
            </div>
        </div>
    </div>
</div>
   

@endsection

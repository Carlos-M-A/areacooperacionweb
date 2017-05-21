@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users management</div>

                <div class="panel-body">
                    <button type="button" class="btn btn-primary btn-block"
                            onclick="event.preventDefault(); document.getElementById('studies_form').submit();">
                        Studies</button>
                    <button type="button" class="btn btn-primary btn-block"
                            onclick="event.preventDefault(); document.getElementById('faculties_form').submit();">
                        Faculties</button>
                    <button type="button" class="btn btn-primary btn-block"
                            onclick="event.preventDefault(); document.getElementById('registrationRequest_form').submit();">
                        Register requests</button>
                    <button type="button" class="btn btn-primary btn-block"
                            onclick="event.preventDefault(); document.getElementById('users_form').submit();">
                        Users</button>
                    <button type="button" class="btn btn-primary btn-block"
                            onclick="event.preventDefault(); document.getElementById('roleChanges_form').submit();">
                        Role changes</button>
                    <button type="button" class="btn btn-primary btn-block"
                            onclick="event.preventDefault(); document.getElementById('createOrganization_form').submit();">
                        Register organization</button>
                    <button type="button" class="btn btn-primary btn-block" 
                            onclick="event.preventDefault(); document.getElementById('observatory_form').submit();">
                                                     The observatory</button>
                    
                    <form id="studies_form" action="{{ route('studies') }}" method="GET" style="display: none;">
                                        </form>
                    <form id="faculties_form" action="{{ route('faculties') }}" method="GET" style="display: none;">
                                        </form>
                    <form id="registrationRequest_form" action="{{ route('registrationRequests') }}" method="GET" style="display: none;">
                                        </form>
                    <form id="users_form" action="{{ route('users') }}" method="GET" style="display: none;">
                                        </form>
                    <form id="roleChanges_form" action="{{ route('roleChanges') }}" method="GET" style="display: none;">
                                        </form>
                    <form id="createOrganization_form" action="{{ route('showRegisterOrganization') }}" method="GET" style="display: none;">
                                        </form>
                    <form id="observatory_form" action="{{ route('observatory') }}" method="GET" style="display: none;">
                                        </form>
                    
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Project management</div>

                <div class="panel-body">
                    
                    <button type="button" class="btn btn-primary btn-block">Projects</button>
                    <button type="button" class="btn btn-primary btn-block">Create project</button>
                </div>
            </div>
        </div>
    </div>
</div>
   

@endsection

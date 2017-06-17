@extends('layouts.app')

@section('content')

@php
    $user = Auth::user();
@endphp

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                @if($user->role == 1)
                    <ul class="nav nav-tabs">
                        <li class=""><a href="{{ route('newOffers') }}">@lang('general.offers')</a></li>
                        <li class=""><a href="{{ route('convocatories') }}">@lang('general.convocatories')</a></li>
                        <li class="active"><a href="{{ route('myProjects') }}">@lang('general.projects')</a></li>
                    </ul>
                @endif
                @if($user->role == 5)
                    <ul class="nav nav-tabs">
                        <li class=""><a href="{{ route('myOffers') }}">@lang('general.offers')</a></li>
                        <li class=""><a href="{{ route('convocatories') }}">@lang('general.convocatories')</a></li>
                        <li class="active"><a href="{{ route('finishedProjects') }}">@lang('general.projects')</a></li>
                        <li class=""><a href="{{ route('searchUsers', ['role' => 0]) }}">@lang('general.users')</a></li>
                    </ul>
                @endif
            <div class="panel panel-info">
                <div class="panel-heading">
                    @lang('general.projects')
                    @if($user->role == 1)
                    <ul class="nav nav-pills">
                        <li class="{{($ask == 1) ? 'active' : ''}}"><a href="{{ route('myProjects') }}">@lang('general.my_projects')</a></li>
                        <li class="{{($ask == 2) ? 'active' : ''}}"><a href="{{ route('proposedProjects') }}">@lang('general.proposed_projects')</a></li>
                    </ul>
                    @elseif($user->role == 2)
                    <ul class="nav nav-pills">
                        <li class="{{($ask == 1) ? 'active' : ''}}"><a href="{{ route('myProjects') }}">@lang('general.my_projects')</a></li>
                        <li class=""><a href="{{ route('showCreateProject') }}">@lang('general.create_project')</a></li>
                    </ul>
                    @elseif($user->role == 5)
                    <ul class="nav nav-pills">
                        <li class="active"><a href="{{ route('finishedProjects') }}">@lang('general.finished_projects')</a></li>
                        <li class=""><a href="{{ route('showCreateProject') }}">@lang('general.create_project')</a></li>
                    </ul>
                    @endif
                </div>
                <div class="panel-body">
                    @foreach($projects as $project)
                        <li class="list-group-item">
                        <!-- Left-aligned -->
                        <div class="media">
                            <div class="media-left">
                                @if($project->createdByAdmin)
                                    <img src="{{url('images/avatar.jpg')}}" class="media-object" style="width:60px">
                                @else
                                    @if(!is_null($project->teacher->user->urlAvatar))
                                    <img src="{{URL::asset($project->teacher->user->urlAvatar)}}" class="media-object" style="width:60px">
                                    @else
                                    <img src="{{url('images/avatar.jpg')}}" class="media-object" style="width:60px">
                                    @endif
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="{{route('project', ['id'=> $project->id])}}" >{{$project->title}}</a>
                                @if($project->state ==1)
                                    <span class="label label-success">@lang('enums.project_state_1')</span>
                                @elseif($project->state ==2)
                                    <span class="label label-warning">@lang('enums.project_state_2')</span>
                                @elseif($project->state ==3)
                                    <span class="label label-danger">@lang('enums.project_state_3')</span>
                                @endif
                                </h4>
                                @if($project->createdByAdmin)
                                    <p>{{$project->tutor}}</p>
                                @else
                                    <p>{{$project->teacher->user->getNameAndSurnames()}}</p>
                                @endif
                            </div>
                        </div>
                        </li>
                        @endforeach
                        {{ $projects->links() }}
                    </div>
        </div>
    </div>
</div>


@endsection

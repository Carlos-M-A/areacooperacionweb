@extends('layouts.app')

@section('content')

@php
    $user = Auth::user();
@endphp

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Projects
                    @if($user->role == 1)
                    <ul class="nav nav-pills">
                        <li class=""><a href="{{ route('myProjects') }}">myProjects</a></li>
                        <li class=""><a href="{{ route('proposedProjects') }}">proposedProjects</a></li>
                    </ul>
                    @elseif($user->role == 2)
                    <ul class="nav nav-pills">
                        <li class=""><a href="{{ route('myProjects') }}">myProjects</a></li>
                    </ul>
                    @endif
                </div>
                <div class="panel-body">
                    @foreach($projects as $project)
                        <li class="list-group-item">
                        <!-- Left-aligned -->
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($project->teacher->user->urlAvatar))
                                <img src="{{URL::asset($project->teacher->user->urlAvatar)}}" class="media-object" style="width:60px">
                                @else
                                <img src="{{url('images/avatar.jpg')}}" class="media-object" style="width:60px">
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
                                <p>{{$project->teacher->user->getNameAndSurnames()}}</p>
                            </div>
                        </div>
                        </li>
                        @endforeach
                <div class="panel-footer">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

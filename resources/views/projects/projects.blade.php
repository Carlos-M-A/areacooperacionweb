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
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>State</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($projects as $project)
                                <tr>
                                    <td><a href="{{route('project', ['id'=> $project->id])}}" >{{$project->title}}</a></td>
                                    <td>{{$project->state}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

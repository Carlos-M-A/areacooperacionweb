@extends('projects.project')

@section('project_options')


<div class="panel-footer">
    <form>
        {{ csrf_field() }}
        <div class="btn-group">
            @if($project->state == 3)
            <button class="btn btn-primary" formmethod="GET" formaction="{{route('showEditProject', ['id'=> $project->id])}}">@lang('general.edit')</button>
            <button class="btn btn-primary" formmethod="POST" formaction="{{route('removeProject', ['id'=> $project->id])}}">@lang('general.remove')</button>
            @endif
            
        </div>
    </form>
</div>

@endsection
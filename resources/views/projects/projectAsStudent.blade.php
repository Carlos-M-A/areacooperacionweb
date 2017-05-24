@extends('projects.project')

@section('project_options')

<div class="panel-footer">
    <form>
        <div class="btn-group">
            
            <button class="btn btn-primary" frommethod="POST" formaction="{{route('showEditProject', ['id'=> $project->id])}}">Edit</button>
            
        </div>
    </form>
</div>

@endsection

@section('project_proposals')



@endsection


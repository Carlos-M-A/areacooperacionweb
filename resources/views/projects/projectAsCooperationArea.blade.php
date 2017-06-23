@extends('projects.project')

@section('project_options')


<div class="panel-footer">
    <form>
        {{ csrf_field() }}
            @if($project->state == 3)
            <button class="btn btn-warning" formmethod="GET" formaction="{{route('showEditProject', ['id'=> $project->id])}}">@lang('general.edit')</button>
            <button class="btn btn-danger" formmethod="POST" formaction="{{route('removeProject', ['id'=> $project->id])}}" 
                    data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.remove_project')"
                    >@lang('general.remove')</button>
            @endif
    </form>
</div>

@endsection
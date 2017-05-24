@extends('projects.project')

@section('project_options')

<div class="panel-footer">
    <form>
        <div class="btn-group">
            <button class="btn btn-primary" frommethod="POST" formaction="">Terminate</button>
            <button class="btn btn-primary" frommethod="POST" formaction="">Start</button>
            <button class="btn btn-primary" frommethod="POST" formaction="{{route('showEditProject', ['id'=> $project->id])}}">Edit</button>
            
        </div>
    </form>
</div>

@endsection

@section('project_proposals')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapseWinningProposals">Tutelage proposals</a>
                            </h4>
    </div>
    <div id="collapseWinningProposals" class="panel-collapse collapse">
        
         @foreach($project->tutelageProposals as $proposal)
            @if($proposal->state == 4)
                <div class="panel-group">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#{{'collapse'.$proposal->teacher->id}}">{{$proposal->teacher->user->getNameAndSurnames()}}</a>
                            </h4>
                        </div>
                    <div id="{{'collapse'.$proposal->teacher->id}}" class="panel-collapse collapse">
                    <ul class="list-group">
                        <li class="list-group-item ">type: {{$proposal->type}}</li>
                        <li class="list-group-item">comment: {{$proposal->comment}}</li>
                        <li class="list-group-item">state: {{$proposal->state}}</li>
                        <li class="list-group-item">wantToBeContacted: {{$proposal->wantToBeContacted}}</li>
                    </ul>
                    </div>
                    </div>
                </div> 
            @endif
        @endforeach
    </div>
</div>

@endsection


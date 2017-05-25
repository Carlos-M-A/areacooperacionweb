@extends('projects.project')

@section('project_options')

<div class="panel-footer">
    <form>
        <div class="btn-group">
            <button class="btn btn-primary" frommethod="POST" formaction="">Terminate</button>
            <button class="btn btn-primary" frommethod="POST" formaction="{{route('showEditProject', ['id'=> $project->id])}}">Edit</button>
            
        </div>
    </form>
</div>

@endsection

@section('project_proposals')


<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
           <a data-toggle="collapse" href="#collapseTutor">Tutor</a>
        </h4>
    </div>
    <div id="collapseTutor" class="panel-collapse collapse">

 
        <div class="panel-group">
            @if($project->state == 1)
                No tutor has been choosen
                @else
                    @if(is_null($tutelageProposalChoosen))
                        {{$project->tutor}}
                    @else
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#{{'collapse'.$tutelageProposalChoosen->teacher->id}}">{{$tutelageProposalChoosen->teacher->user->getNameAndSurnames()}}</a>
                                </h4>
                            </div>
                        
                            <div id="{{'collapse'.$tutelageProposalChoosen->teacher->id}}" class="panel-collapse collapse">
                                <ul class="list-group">
                                    <li class="list-group-item">comment: {{$tutelageProposalChoosen->comment}}</li>
                                    <li class="list-group-item">state: {{$tutelageProposalChoosen->state}}</li>
                                    <li class="list-group-item">wantsToBeContacted: {{$tutelageProposalChoosen->wantsToBeContacted}}</li>
                                    <li class="list-group-item">phone: {{$tutelageProposalChoosen->teacher->user->phone}}</li>
                                    <li class="list-group-item">email: {{$tutelageProposalChoosen->teacher->user->email}}</li>
                                    <li class="list-group-item">areasOfInterest: {{$tutelageProposalChoosen->teacher->areasOfInterest}}</li>
                                    <li class="list-group-item">departments: {{$tutelageProposalChoosen->teacher->departments}}</li>
                                </ul>
                            </div>
                        </div>
                    @endif
                @endif
        </div> 
    </div>
    @if($project->state == 1)
    <div class="panel-footer">
            <!-- Trigger the modal to enter the tutor manually -->
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalOfEnterTutorManually">Enter tutor manually</button>
    </div>
    @endif
</div>

@if($project->state == 1)
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
           <a data-toggle="collapse" href="#collapseTutelageProposals">Tutelage proposals <span class="badge">{{count($project->tutelageProposals)}}</span></a>
        </h4>
    </div>
    <div id="collapseTutelageProposals" class="panel-collapse collapse">
        
         @foreach($project->tutelageProposals as $proposal)
            @if($proposal->state == 1)
                <div class="panel-group">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#{{'collapse'.$proposal->teacher->id}}">{{$proposal->teacher->user->getNameAndSurnames()}}</a>
                            </h4>
                        </div>
                    <div id="{{'collapse'.$proposal->teacher->id}}" class="panel-collapse collapse">
                    <ul class="list-group">
                        <li class="list-group-item">comment: {{$proposal->comment}}</li>
                        <li class="list-group-item">state: {{$proposal->state}}</li>
                        <li class="list-group-item">wantsToBeContacted: {{$proposal->wantsToBeContacted}}</li>
                        <li class="list-group-item">phone: {{$proposal->teacher->user->phone}}</li>
                        <li class="list-group-item">email: {{$proposal->teacher->user->email}}</li>
                        <li class="list-group-item">areasOfInterest: {{$proposal->teacher->areasOfInterest}}</li>
                        <li class="list-group-item">departments: {{$proposal->teacher->departments}}</li>
                    </ul>
                    </div>
                        <div class="panel-footer">
                            <form>
                                {{ csrf_field() }}
                                <div class="btn-group">
                                    <button class="btn btn-success" type="submit" formmethod="POST" formaction="{{route('acceptTutelageProposal', ['id'=> $proposal->id])}}">Choose</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
            @endif
        @endforeach
    </div>
</div>
@endif


@endsection



<!-- Modal -->
<div id="modalOfEnterTutorManually" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter data of tutor</h4>
      </div>
      <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('enterTutorManually', ['id' => $project->id]) }}">
                        {{ csrf_field() }}
                        <div id="name_div" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div id="surnames_div" class="form-group{{ $errors->has('surnames') ? ' has-error' : '' }}">
                            <label for="surnames" class="col-md-4 control-label">surnames</label>

                            <div class="col-md-6">
                                <input id="surnames" type="text" class="form-control" name="surnames" value="{{ old('surnames') }}" autofocus>

                                @if ($errors->has('surnames'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('surnames') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@extends('projects.project')

@section('project_options')

@if($project->state <=2)
<div class="panel-footer">
    <form>
        <div class="btn-group">
            @if($project->state == 2)
            <!-- Trigger the modal to terminate project -->
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalOfTerminateProject">@lang('general.finish')</button>
            @endif
            <button class="btn btn-primary" frommethod="POST" formaction="{{route('showEditProject', ['id'=> $project->id])}}">@lang('general.edit')</button>
            
        </div>
    </form>
</div>
@endif

@endsection

@section('project_proposals')


<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
           <a data-toggle="collapse" href="#collapseTutor">@lang('general.tutor')</a>
        </h4>
    </div>
    <div id="collapseTutor" class="panel-collapse collapse">

 
        <div class="panel-group">
            @if($project->state == 1)
                @lang('general.no_tutor_has_been_chosen')
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
           <a data-toggle="collapse" href="#collapseTutelageProposals">@lang('general.tutelage_proposals') <span class="badge">{{count($project->tutelageProposals)}}</span></a>
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


@if($project->state == 1)
<!-- Modal of enter tutor -->
<div id="modalOfEnterTutorManually" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('general.enter_data_of_tutor')</h4>
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
                                    @lang('general.save')
                                </button>
                            </div>
                        </div>
                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('general.close')</button>
      </div>
    </div>

  </div>
</div>
@endif

@if($project->state == 2)
<!-- Modal of terminate project -->
<div id="modalOfTerminateProject" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('general.enter_url_to_documentation')</h4>
      </div>
      <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('terminateProject', ['id' => $project->id]) }}">
                        {{ csrf_field() }}
                        <div id="urlDocumentation_div" class="form-group{{ $errors->has('urlDocumentation') ? ' has-error' : '' }}">
                            <label for="urlDocumentation" class="col-md-4 control-label">urlDocumentation</label>

                            <div class="col-md-6">
                                <input id="urlDocumentation" type="url" class="form-control" name="urlDocumentation" value="{{ old('urlDocumentation') }}" required>

                                @if ($errors->has('urlDocumentation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('urlDocumentation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('general.finish')
                                </button>
                            </div>
                        </div>
                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('general.close')</button>
      </div>
    </div>

  </div>
</div>
@endif
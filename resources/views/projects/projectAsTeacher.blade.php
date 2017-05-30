@extends('projects.project')

@section('project_options')

@if($project->state <=2)
<div class="panel-footer">
    <form>
        <div class="btn-group">
            @if($project->state == 2)
            <!-- Trigger the modal to terminate project -->
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalOfFinishProject">@lang('general.finish')</button>
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
           <a data-toggle="collapse" href="#collapseTutor">@lang('general.author')</a>
        </h4>
    </div>
    <div id="collapseTutor" class="panel-collapse collapse">

 
        <div class="panel-group">
            @if(is_null($tutelageProposalChoosen))
                @lang('general.no_author_has_been_chosen')
                @else
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#{{'collapse'.$tutelageProposalChoosen->student->id}}">{{$tutelageProposalChoosen->student->user->getNameAndSurnames()}}</a>
                            </h4>
                        </div>
                    
                        <div id="{{'collapse'.$tutelageProposalChoosen->student->id}}" class="panel-collapse collapse">
                            <ul class="list-group">
                                <li class="list-group-item">state: {{$tutelageProposalChoosen->state}}</li>
                                <li class="list-group-item">comment: {{$tutelageProposalChoosen->comment}}</li>
                                <li class="list-group-item">phone: {{$tutelageProposalChoosen->student->user->phone}}</li>
                                <li class="list-group-item">email: {{$tutelageProposalChoosen->student->user->email}}</li>
                                <li class="list-group-item">areasOfInterest: {{$tutelageProposalChoosen->student->areasOfInterest}}</li>
                                <li class="list-group-item">skills: {{$tutelageProposalChoosen->student->skills}}</li>
                                <li class="list-group-item">urlCurriculum: {{$tutelageProposalChoosen->student->urlCurriculum}}</li>
                            </ul>
                        </div>
                    </div>
                @endif
        </div> 
    </div>
    @if($project->state == 2)
    <div class="panel-footer">
            <!-- Trigger the modal to enter the tutor manually -->
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#cancelAuthor">Cancel author</button>
    </div>
    @endif
</div>

@if($project->state <= 2)
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
           <a data-toggle="collapse" href="#collapseTutelageProposals">@lang('general.tutelage_proposals') <span class="badge">{{count($project->tutelageProposals)}}</span></a>
        </h4>
    </div>
    <div id="collapseTutelageProposals" class="panel-collapse collapse">
        
         @foreach($project->tutelageProposals as $proposal)
            @if($proposal->state != 2)
                <div class="panel-group">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#{{'collapse'.$proposal->student->id}}">{{$proposal->student->user->getNameAndSurnames()}}</a>
                            </h4>
                        </div>
                    <div id="{{'collapse'.$proposal->student->id}}" class="panel-collapse collapse">
                    <ul class="list-group">
                        <li class="list-group-item">state: {{$proposal->state}}</li>
                        <li class="list-group-item">comment: {{$proposal->comment}}</li>
                        <li class="list-group-item">phone: {{$proposal->student->user->phone}}</li>
                        <li class="list-group-item">email: {{$proposal->student->user->email}}</li>
                        <li class="list-group-item">areasOfInterest: {{$proposal->student->areasOfInterest}}</li>
                        <li class="list-group-item">skills: {{$proposal->student->skills}}</li>
                        <li class="list-group-item">urlCurriculum: {{$proposal->student->urlCurriculum}}</li>
                    </ul>
                    </div>
                       @if($proposal->state == 1)
                        <div class="panel-footer">
                            <form>
                                {{ csrf_field() }}
                                <div class="btn-group">
                                    <button class="btn btn-success" type="submit" formmethod="POST" formaction="{{route('acceptTutelageProposal', ['id'=> $proposal->id])}}">Choose</button>
                                </div>
                            </form>
                        </div>
                       @endif
                    </div>
                </div> 
            @endif
        @endforeach
    </div>
</div>
@endif


@endsection


@if($project->state == 2 && !is_null($tutelageProposalChoosen))
<!-- Modal of cancel the author chosen -->
<div id="cancelAuthor" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Remove author</h4>
      </div>
      <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{route('cancelTutelageProposal', ['id' => $tutelageProposalChoosen->id])}}">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('general.cancel')
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
<!-- Modal of finish project -->
<div id="modalOfFinishProject" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('general.enter_url_to_documentation')</h4>
      </div>
      <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('finishProject', ['id' => $project->id]) }}">
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
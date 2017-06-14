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
            <button class="btn btn-primary" formmethod="GET" formaction="{{route('showEditProject', ['id'=> $project->id])}}">@lang('general.edit')</button>
            
        </div>
    </form>
</div>
@endif

@endsection

@section('project_inscriptions')


<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
           <a>@lang('general.author')</a>
        </h4>
    </div>
    <div class="panel-body">

 
        <div class="panel-group">
            @if(is_null($inscriptionInProjectChosen))
                @lang('general.no_author_has_been_chosen')
                @else
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        <!-- Left-aligned -->
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($inscriptionInProjectChosen->student->user->urlAvatar))
                                <img src="{{URL::asset($inscriptionInProjectChosen->student->user->urlAvatar)}}" class="media-object" style="width:60px">
                                @else
                                <img src="{{url('images/avatar.jpg')}}" class="media-object" style="width:60px">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a data-toggle="collapse" href="#{{'collapse'.$inscriptionInProjectChosen->student->id}}">{{$inscriptionInProjectChosen->student->user->getNameAndSurnames()}}</a>
                                    <span class="label label-success">@lang('enums.inscription_in_project_state_2')</span>
                                </h4>
                                <p>
                                    @if($project->state == 2)
                                        <!-- Trigger the modal to enter the tutor manually -->
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#cancelAuthor">Cancel author</button>
                                    @endif
                                </p>
                            </div>
                        </div>
                        </li>
                        </div>
                    <div id="{{'collapse'.$inscriptionInProjectChosen->student->id}}" class="panel-collapse collapse">
                    
                    </div>
                    </div>
                @endif
        </div> 
    </div>
</div>

@if($project->state <= 2)
<div class="panel panel-default">
    <div class="panel-heading">
        <ul class="nav nav-pills">
                        <li class="{{old('stateOfInscriptions')==1 ? 'active' : ''}}"><a href="{{ route('project', ['id'=> $project->id, 'stateOfInscriptions' => 1]) }}">Inscriptions<span class="badge">{{$project->getAmountOfNotChosenInscriptions()}}</span></a></li>
                        <li class="{{old('stateOfInscriptions')==3 ? 'active' : ''}}"><a href="{{ route('project', ['id'=> $project->id, 'stateOfInscriptions' => 3]) }}">Cancelled inscriptions<span class="badge">{{$project->getAmountOfCancelledInscriptions()}}</span></a></li>
                    </ul>
    </div>
    <div class="panel-body">
        
         @foreach($inscriptions as $inscription)
                <div class="panel-group">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        <!-- Left-aligned -->
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($inscription->student->user->urlAvatar))
                                <img src="{{URL::asset($inscription->student->user->urlAvatar)}}" class="media-object" style="width:60px">
                                @else
                                <img src="{{url('images/avatar.jpg')}}" class="media-object" style="width:60px">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a data-toggle="collapse" href="#{{'collapse'.$inscription->student->id}}">{{$inscription->student->user->getNameAndSurnames()}}</a>
                                @if($inscription->state == 1)
                                    <span class="label label-info">@lang('enums.inscription_in_project_state_1')</span>
                                @elseif($inscription->state == 2)
                                    <span class="label label-success">@lang('enums.inscription_in_project_state_2')</span>
                                @elseif($inscription->state == 3)
                                    <span class="label label-danger">@lang('enums.inscription_in_project_state_3')</span>
                                @endif
                                </h4>
                                <p>
                                    @if($inscription->state == 1 && $project->state == 1)
                                        <form>
                                            {{ csrf_field() }}
                                            <div class="btn-group">
                                                <button class="btn btn-success" type="submit" formmethod="POST" formaction="{{route('acceptInscriptionInProject', ['id'=> $inscription->id])}}">Choose</button>
                                            </div>
                                        </form>
                                   @endif
                                </p>
                            </div>
                        </div>
                        </li>
                        </div>
                    <div id="{{'collapse'.$inscription->student->id}}" class="panel-collapse collapse">
                    <ul class="list-group">
                        <li class="list-group-item">state: {{$inscription->state}}</li>
                        <li class="list-group-item">comment: {{$inscription->comment}}</li>
                        <li class="list-group-item">phone: {{$inscription->student->user->phone}}</li>
                        <li class="list-group-item">email: {{$inscription->student->user->email}}</li>
                        <li class="list-group-item">areasOfInterest: {{$inscription->student->areasOfInterest}}</li>
                        <li class="list-group-item">skills: {{$inscription->student->skills}}</li>
                        <li class="list-group-item">urlCurriculum: {{$inscription->student->urlCurriculum}}</li>
                    </ul>
                    </div>
                    </div>
                </div>
        @endforeach
    </div>
    <div class="panel-footer">
                    {{ $inscriptions->appends(['stateOfInscriptions' => old('stateOfInscriptions')])->links() }}
    </div>
</div>
@endif


@endsection


@if($project->state == 2 && !is_null($inscriptionInProjectChosen))
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
                    <form class="form-horizontal" role="form" method="POST" action="{{route('cancelInscriptionInProject', ['id' => $inscriptionInProjectChosen->id])}}">
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
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


<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">
           <a>@lang('general.author')</a>
        </h4>
    </div>
    <div class="panel-body">

 
        <div class="panel-group">
            @if(is_null($inscriptionInProjectChosen))
                @lang('explanations.no_author_has_been_chosen')
                @else
                    @php
                        $autor = App\User::find($inscriptionInProjectChosen->student_id);
                    @endphp
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        <!-- Left-aligned -->
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($autor->urlAvatar))
                                <img src="{{url($autor->urlAvatar)}}" class="media-object" style="width:60px">
                                @else
                                <img src="{{URL::asset('images/avatar.jpg')}}" class="media-object" style="width:60px">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a data-toggle="collapse" href="#{{'collapse'.$autor->id}}">{{$autor->getNameAndSurnames()}}</a>
                                    <span class="label label-success">@lang('enums.inscription_in_project_state_2')</span>
                                </h4>
                                <p>
                                    <form>
                                    {{ csrf_field() }}
                                    <button class="btn btn-info" type="submit" formmethod="GET" formaction="{{route('user', ['id'=> $autor->id])}}">@lang('general.view')</button>
                                    @if($project->state == 2)
                                    
                                        <button type="submit" class="btn btn-warning" formmethod="POST" formaction="{{route('cancelInscriptionInProject', ['id' => $inscriptionInProjectChosen->id])}}"
                                                data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.cancel_author')"
                                                >@lang('general.cancel')</button>
                                    @endif
                                    </form>
                                    
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
<div class="panel panel-info">
    <div class="panel-heading">
        <ul class="nav nav-pills">
            @if(is_null(old('stateOfInscriptions')))
            <li class="active"><a href="{{ route('project', ['id'=> $project->id, 'stateOfInscriptions' => 1]) }}">@lang('general.inscriptions')<span class="badge">{{$project->getAmountOfNotChosenInscriptions()}}</span></a></li>
            @else
                <li class="{{old('stateOfInscriptions')==1 ? 'active' : ''}}"><a href="{{ route('project', ['id'=> $project->id, 'stateOfInscriptions' => 1]) }}">@lang('general.inscriptions')<span class="badge">{{$project->getAmountOfNotChosenInscriptions()}}</span></a></li>
            @endif
                <li class="{{old('stateOfInscriptions')==3 ? 'active' : ''}}"><a href="{{ route('project', ['id'=> $project->id, 'stateOfInscriptions' => 3]) }}">@lang('general.cancelled')<span class="badge">{{$project->getAmountOfCancelledInscriptions()}}</span></a></li>
                    </ul>
    </div>
    <div class="panel-body">
        
         @foreach($inscriptions as $inscription)
            @php
                $user = App\User::find($inscription->student_id);
            @endphp
                <div class="panel-group">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        <!-- Left-aligned -->
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($user->urlAvatar))
                                <img src="{{url($user->urlAvatar)}}" class="media-object" style="width:60px">
                                @else
                                <img src="{{URL::asset('images/avatar.jpg')}}" class="media-object" style="width:60px">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a data-toggle="collapse" href="#{{'collapse'.$user->id}}">{{$user->getNameAndSurnames()}}</a>
                                @if($inscription->state == 1)
                                    <span class="label label-info">@lang('enums.inscription_in_project_state_1')</span>
                                @elseif($inscription->state == 2)
                                    <span class="label label-success">@lang('enums.inscription_in_project_state_2')</span>
                                @elseif($inscription->state == 3)
                                    <span class="label label-danger">@lang('enums.inscription_in_project_state_3')</span>
                                @endif
                                </h4>
                                <p>
                                <form>
                                    {{ csrf_field() }}
                                    <button class="btn btn-info" type="submit" formmethod="GET" formaction="{{route('user', ['id'=> $user->id])}}">@lang('general.view')</button>
                                    @if($inscription->state == 1 && $project->state == 1)
                                                <button class="btn btn-success" type="submit" formmethod="POST" formaction="{{route('acceptInscriptionInProject', ['id'=> $inscription->id])}}"
                                                        data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.chose_author')"
                                                        >@lang('general.chose')</button>
                                    @endif
                                </form>
                                </p>
                            </div>
                        </div>
                        </li>
                        </div>
                    <div id="{{'collapse'.$user->id}}" class="panel-collapse collapse">
                    <ul class="list-group">
                        <li class="list-group-item"><b>@lang('models.comment'):</b> {{$inscription->comment}}</li>
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




@if($project->state == 2)
<!-- Modal of finish project -->
<div id="modalOfFinishProject" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('general.enter_url_to_documentation')</h4>
        <p>@lang('explanations.finish_project')</p>
      </div>
      <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('finishProject', ['id' => $project->id]) }}">
                        {{ csrf_field() }}
                        <div id="urlDocumentation_div" class="form-group{{ $errors->has('urlDocumentation') ? ' has-error' : '' }}">
                            <label for="urlDocumentation" class="col-md-4 control-label">@lang('models.urlDocumentation')</label>

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
                                <button type="submit" class="btn btn-warning">
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
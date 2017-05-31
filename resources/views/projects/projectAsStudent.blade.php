@extends('projects.project')

@section('teacher_proposal')

@if(is_null($inscriptionInProject) && $project->state==1)

<div class="panel panel-default">
                <div class="panel-heading">@lang('general.create_inscription_in_project')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('createInscriptionInProject', ['id' => $project->id]) }}">
                        {{ csrf_field() }}


                        <div id="comment_div" class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                            <label for="comment" class="col-md-4 control-label">comment</label>

                            <div class="col-md-6">
                                <input id="comment" type="text" class="form-control" name="comment" value="{{ old('comment') }}" autofocus>

                                @if ($errors->has('comment'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('comment') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('general.create')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

@else

 <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapseProposal">Your inscription - {{$inscriptionInProject->getStateName()}}</a>
                            </h4>
                        </div>
                    <div id="collapseProposal" class="panel-collapse collapse">
                    <ul class="list-group">
                        <li class="list-group-item">state: {{$inscriptionInProject->state}}</li>
                        <li class="list-group-item">comment: {{$inscriptionInProject->comment}}</li>
                    </ul>
                    </div>
                    @if($inscriptionInProject->state != 3 && $project->state != 3)
                    <div class="panel-footer">
                        <form>
                                {{ csrf_field() }}
                                <div class="btn-group">
                                    @if($inscriptionInProject->state == 1)
                                    <button class="btn btn-danger" type="submit" formmethod="POST" formaction="{{route('removeInscriptionInProject', ['id'=> $inscriptionInProject->id])}}">@lang('general.remove')</button>
                                    @endif
                                    @if($inscriptionInProject->state == 2)
                                    <button class="btn btn-danger" type="submit" formmethod="POST" formaction="{{route('cancelInscriptionInProject', ['id'=> $inscriptionInProject->id])}}">@lang('general.cancel')</button>
                                    @endif
                                </div>
                            </form>
                    </div>
                    @endif
                </div>
            </div>
@endif


@endsection
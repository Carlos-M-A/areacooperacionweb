@extends('projects.project')

@section('teacher_proposal')

@if(is_null($tutelageProposal))

<div class="panel panel-default">
                <div class="panel-heading">Create tutelage proposal</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('createTutelageProposal', ['id' => $project->id]) }}">
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
                        
                        <div id="wantsToBeContacted_div" class="form-group{{ $errors->has('wantsToBeContacted') ? ' has-error' : '' }}">
                            <label for="wantsToBeContacted" class="col-md-4 control-label">wantsToBeContacted</label>

                            <div class="col-md-6">
                                <label class="radio-inline"><input id="wantsToBeContacted" type="radio" name="wantsToBeContacted" value="1">Yes</label>
                                <label class="radio-inline"><input id="wantsToBeContacted" type="radio" name="wantsToBeContacted" value="0">No</label>
                                @if ($errors->has('wantsToBeContacted'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('wantsToBeContacted') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Make proposal
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
                                <a data-toggle="collapse" href="#collapseProposal">Your proposal - {{$tutelageProposal->getStateName()}}</a>
                            </h4>
                        </div>
                    <div id="collapseProposal" class="panel-collapse collapse">
                    <ul class="list-group">
                        <li class="list-group-item">state: {{$tutelageProposal->state}}</li>
                        <li class="list-group-item">comment: {{$tutelageProposal->comment}}</li>
                        <li class="list-group-item">wantsToBeContacted: {{$tutelageProposal->wantsToBeContacted}}</li>
                    </ul>
                    </div>
                    <div class="panel-footer">
                        <form>
                                {{ csrf_field() }}
                                <div class="btn-group">
                                    @if($tutelageProposal->state == 1)
                                    <button class="btn btn-danger" type="submit" formmethod="POST" formaction="{{route('removeTutelageProposal', ['id'=> $tutelageProposal->id])}}">Remove</button>
                                    @endif
                                </div>
                            </form>
                    </div>
                </div>
            </div>
@endif


@endsection
@extends('projects.project')

@section('more_script')
<script>
    $( document ).ready(function() {
        $('textarea').keyup(function(event) {
            var text_max = $('#' + event.target.id).attr('maxlength');
            var text_length = $('#' + event.target.id).val().length;
            var text_remaining = text_max - text_length;
            
            $('#' + event.target.id).next().html(text_length + ' / ' + text_max);
        });
    });
</script>
@endsection

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
                                <textarea id="comment" cols="100" rows="7" maxlength="{{config('forms.comment')}}"
                                           class="form-control" name="comment" autofocus>{{ old('comment') }}</textarea>
                                           <span class="pull-right label label-default"></span>
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
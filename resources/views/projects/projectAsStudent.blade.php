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


@section('project_tutor')
<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">
           <a>@lang('general.tutor')</a>
        </h4>
    </div>
    <div class="panel-body">

 
        <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        <!-- Left-aligned -->
                        <div class="media">
                            @php
                                $tutor = App\User::find($project->teacher_id);
                            @endphp
                            <div class="media-left">
                                @if(!is_null($tutor->urlAvatar))
                                <img src="{{url($tutor->urlAvatar)}}" class="media-object" style="width:60px">
                                @else
                                <img src="{{URL::asset('images/avatar.jpg')}}" class="media-object" style="width:60px">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{$tutor->getNameAndSurnames()}}</h4>
                                <p>
                                <form>
                                        <button class="btn btn-info" type="submit" formmethod="GET" formaction="{{route('user', ['id'=> $tutor->id])}}">@lang('general.view')</button>
                                </form>
                                </p>
                            </div>
                        </div>
                        </li>
                        </div>
                    </div>
        </div> 
    </div>
</div>
@endsection


@section('student_inscription')

@if(is_null($inscriptionInProject) && $project->state==1 && $project->study_id==Auth::user()->student->study_id && !Auth::user()->student->hasProjectAssigned())

<div class="panel panel-info">
                <div class="panel-heading">@lang('general.create_inscription_in_project')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('createInscriptionInProject', ['id' => $project->id]) }}">
                        {{ csrf_field() }}


                        <div id="comment_div" class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                            <label for="comment" class="col-md-4 control-label">@lang('models.comment')</label>

                            <div class="col-md-6">
                                <textarea id="comment" cols="100" rows="7" maxlength="{{config('forms.comment')}}"
                                           class="form-control" name="comment" autofocus required>{{ old('comment') }}</textarea>
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

@elseif(!is_null($inscriptionInProject))
<div class="panel-group">
                   <div class="panel panel-default">
                        <div class="panel-heading">
                        <!-- Left-aligned -->
                        <div class="media">
                            @lang('general.your_inscription')
                            <div class="media-left">
                                @if(!is_null($inscriptionInProject->student->user->urlAvatar))
                                <img src="{{url($inscriptionInProject->student->user->urlAvatar)}}" class="media-object" style="width:60px">
                                @else
                                <img src="{{URL::asset('images/avatar.jpg')}}" class="media-object" style="width:60px">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a data-toggle="collapse" href="#collapseProposal">{{$inscriptionInProject->student->user->getNameAndSurnames()}}</a>
                                @if($inscriptionInProject->state == 1)
                                    <span class="label label-info">@lang('enums.inscription_in_project_state_1')</span>
                                @elseif($inscriptionInProject->state == 2)
                                    <span class="label label-success">@lang('enums.inscription_in_project_state_2')</span>
                                @elseif($inscriptionInProject->state == 3)
                                    <span class="label label-danger">@lang('enums.inscription_in_project_state_3')</span>
                                @endif
                                </h4>
                                <p>
                                    @if($project->state <= 2)
                                    <form>
                                        {{ csrf_field() }}
                                            @if($inscriptionInProject->state == 1)
                                            <button class="btn btn-danger" type="submit" formmethod="POST" formaction="{{route('removeInscriptionInProject', ['id'=> $inscriptionInProject->id])}}" 
                                                    data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.remove_inscription_in_project')"
                                                    >@lang('general.remove')</button>
                                            @endif
                                            @if($inscriptionInProject->state == 2)
                                            <button class="btn btn-danger" type="submit" formmethod="POST" formaction="{{route('cancelInscriptionInProject', ['id'=> $inscriptionInProject->id])}}"
                                                    data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.cancel_be_the_author')"
                                                    >@lang('general.cancel')</button>
                                            @endif
                                    </form>
                                    @endif
                                </p>
                            </div>
                        </div>
                        </li>
                        </div>
                    <div id="collapseProposal" class="panel-collapse collapse">
                    <ul class="list-group">
                        <li class="list-group-item"><b>@lang('models.comment'):</b> {{$inscriptionInProject->comment}}</li>
                    </ul>
                    </div>
                    </div>
                </div>


@endif


@endsection
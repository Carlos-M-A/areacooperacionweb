@extends('convocatories.convocatory')

@section('more_script')
<script>
$(document).ready(function(){
    $(".evaluate_button").click(function(event){
        
        var id = event.target.id;
        var urlEditInscription = "{{ route('root')}}" + "/inscriptions/" + id + "/edit";
        $('#modal_form').attr("action", urlEditInscription);
        $("#modalEvaluateInscription").modal();
    });
});
</script>
@endsection


@section('convocatory_options')
    <div class="panel-footer">
        <form>
            {{ csrf_field() }}
            <div class="btn-group">
                <button class="btn btn-warning" formmethod="GET" formaction="{{route('showEditConvocatory', ['id'=> $convocatory->id])}}">@lang('edit')</button>
                @if($convocatory->state == 2)
                <button class="btn btn-warning" formmethod="POST" formaction="{{route('closeConvocatory', ['id'=> $convocatory->id])}}">@lang('close')</button>
                @endif
            </div>
        </form>
    </div>
@endsection

@section('convocatory_inscriptions')
<div class="panel panel-info">
    <div class="panel-heading">
        Inscriptions
        <ul class="nav nav-pills">
                        <li class="{{old('stateOfInscriptions')==1 ? 'active' : ''}}"><a href="{{ route('convocatory', ['id'=> $convocatory->id, 'stateOfInscriptions' => 1]) }}">Inscriptions<span class="badge">{{$convocatory->getAmountOfNotEvaluatedInscriptions()}}</span></a></li>
                        <li class="{{old('stateOfInscriptions')==2 ? 'active' : ''}}"><a href="{{ route('convocatory', ['id'=> $convocatory->id, 'stateOfInscriptions' => 2]) }}">Accepted<span class="badge">{{$convocatory->getAmountOfAcceptedInscriptions()}}</span></a></li>
                        <li class="{{old('stateOfInscriptions')==3 ? 'active' : ''}}"><a href="{{ route('convocatory', ['id'=> $convocatory->id, 'stateOfInscriptions' => 3]) }}">Alternate<span class="badge">{{$convocatory->getAmountOfAlternateInscriptions()}}</span></a></li>
                        <li class="{{old('stateOfInscriptions')==4 ? 'active' : ''}}"><a href="{{ route('convocatory', ['id'=> $convocatory->id, 'stateOfInscriptions' => 4]) }}">Rejected<span class="badge">{{$convocatory->getAmountOfRejectedInscriptions()}}</span></a></li>
                        <li class="{{old('stateOfInscriptions')==5 ? 'active' : ''}}"><a href="{{ route('convocatory', ['id'=> $convocatory->id, 'stateOfInscriptions' => 5]) }}">Cancelled inscriptions<span class="badge">{{$convocatory->getAmountOfCancelledInscriptions()}}</span></a></li>
                    </ul>
    </div>
    <div class="panel-body">  
@foreach($inscriptions as $inscription)
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
                                    <a data-toggle="collapse" href="#collapseProposa{{$inscription->student->user->id}}">{{$inscription->student->user->getNameAndSurnames()}}</a>
                                @if($inscription->state == 1)
                                    <span class="label label-info">@lang('enums.inscription_state_1')</span>
                                @elseif($inscription->state == 2)
                                    <span class="label label-success">@lang('enums.inscription_state_2')</span>
                                @elseif($inscription->state == 3)
                                    <span class="label label-warning">@lang('enums.inscription_state_3')</span>
                                @elseif($inscription->state == 4)
                                    <span class="label label-danger">@lang('enums.inscription_state_4')</span>
                                @elseif($inscription->state == 5)
                                    <span class="label label-danger">@lang('enums.inscription_state_5')</span>
                                @endif
                                <span class="label label-info">{{$inscription->score}}</span></h4>
                                <p>
                                    @if($convocatory->state == 1 && $inscription->state != 5)
                                        <form>
                                                {{ csrf_field() }}
                                                <div class="btn-group">
                                                    <!-- Trigger the modal to evaluate the inscription -->
                                                    <button id="{{$inscription->id}}" type="button" class="btn btn-primary evaluate_button" data-toggle="modal"  >@lang('general.evaluate')</button>
                                                </div>
                                            </form>
                                    @endif
                                </p>
                            </div>
                        </div>
                        </li>
            </div>
                <div id="collapseProposa{{$inscription->student->user->id}}" class="panel-collapse collapse">
                    <ul class="list-group">
                        <li class="list-group-item"><b>@lang('models.observations'):</b> {{$inscription->observations}}</li>
                    </ul>
                        
                    
                        
                </div>
    </div>
@endforeach
    </div>
    <div class="panel-footer">
                    {{ $inscriptions->appends(['stateOfInscriptions' => old('stateOfInscriptions')])->links() }}
    </div>
</div>




@if($convocatory->state == 1)
<!-- Modal -->
<div id="modalEvaluateInscription" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('general.evaluate')</h4>
      </div>
      <div class="modal-body">
                    <form id="modal_form" class="form-horizontal" role="form" method="POST" action="">
                            {{ csrf_field() }}
                            
                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">state</label>

                            <div class="col-md-6">
                                <select  id="type" class="form-control" name="state" autofocus>
                                    <option value="2">Accepted</option>
                                    <option value="3">Alternate</option>
                                    <option value="4">Rejected</option>
                                </select>

                                @if ($errors->has('state'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="score_div" class="form-group{{ $errors->has('score') ? ' has-error' : '' }}">
                            <label for="score" class="col-md-4 control-label">score</label>

                            <div class="col-md-6">
                                <input id="score" type="number" min='0' max='10' step="0.01" class="form-control" name="score" value="{{ old('score')}}" autofocus required>

                                @if ($errors->has('score'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('score') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div id="observations_div" class="form-group{{ $errors->has('observations') ? ' has-error' : '' }}">
                            <label for="observations" class="col-md-4 control-label">observations</label>

                            <div class="col-md-6">
                                <input id="observations" type="text" class="form-control" name="observations" value="{{ old('observations')}}" autofocus required>

                                @if ($errors->has('observations'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('observations') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    @lang('general.save')
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


@endif

@endsection
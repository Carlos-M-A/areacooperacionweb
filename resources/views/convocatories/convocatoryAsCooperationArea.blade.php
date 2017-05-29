@extends('convocatories.convocatory')

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



<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapseWinningProposals">Inscriptions</a>
                            </h4>
    </div>
    <div id="collapseWinningProposals" class="panel-collapse collapse">  
@foreach($convocatory->inscriptions as $inscription)
    <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapseProposal">{{$inscription->student->user->getNameAndSurnames()}}</a>
                </h4>
            </div>
        <div id="collapseProposal" class="panel-collapse collapse">
        <ul class="list-group">
            <li class="list-group-item ">state: {{$inscription->state}}</li>
            <li class="list-group-item">score: {{$inscription->score}}</li>
            <li class="list-group-item">observations: {{$inscription->observations}}</li>
        </ul>
        </div>
        @if($convocatory->state == 1)
        <div class="panel-footer">
            <form>
                    {{ csrf_field() }}
                    <div class="btn-group">
                        <!-- Trigger the modal to evaluate the inscription -->
                        <button id="{{$inscription->id}}" type="button" class="btn btn-primary evaluate_button" data-toggle="modal"  >@lang('general.evaluate')</button>
                    </div>
                </form>
        </div>
        @endif
    </div>
@endforeach
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
@extends('convocatories.convocatory')


@section('convocatory_options')

@if($convocatory->state==1 && is_null($inscription))
    <div class="panel-footer">
        <form>
            {{ csrf_field() }}
            <div class="btn-group">
                <button class="btn btn-warning" formmethod="POST" formaction="{{route('createInscription', ['id'=> $convocatory->id])}}">@lang('register')</button>
            </div>
        </form>
    </div>
@endif

@endsection




@section('inscription')
@if(!is_null($inscription))
    <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapseProposal">Your inscription</a>
                </h4>
            </div>
        <div id="collapseProposal" class="panel-collapse collapse">
        <ul class="list-group">
            <li class="list-group-item ">state: {{$inscription->state}}</li>
            <li class="list-group-item">score: {{$inscription->score}}</li>
            <li class="list-group-item">observations: {{$inscription->observations}}</li>
        </ul>
        </div>
        <div class="panel-footer">
            <form>
                    {{ csrf_field() }}
                    <div class="btn-group">
                        @if($convocatory->state == 1)
                        <button class="btn btn-danger" type="submit" formmethod="POST" formaction="{{route('removeInscription', ['id'=> $inscription->id])}}">@lang('general.remove')</button>
                        @endif
                    </div>
                </form>
        </div>
    </div>
            
@endif
@endsection
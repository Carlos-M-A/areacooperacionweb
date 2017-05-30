@extends('offers.offer')

@section('offer_options')

@endsection



@section('student_proposal')

<script>
    
    /**
    * This function is called when reload the page to the form renember the chosen type.
    * Update the type (It is changed for the selected type above)
    */
    function updateSelectedType(type){
        var selectedType = document.getElementById('type');
        op0 = document.getElementById('typeOption0');
        op1 = document.getElementById('typeOption1');
        op2 = document.getElementById('typeOption2');
        op3 = document.getElementById('typeOption3');
        op4 = document.getElementById('typeOption4');
        op5 = document.getElementById('typeOption5');
        op6 = document.getElementById('typeOption6');
        
        switch (type){
            
            case 1:
                newOption = op1.cloneNode(true);
                newOption.selected = true;
                selectedType.replaceChild(newOption, op0);
                selectedType.removeChild(op1);
                break;
            case 2:
                newOption = op2.cloneNode(true);
                newOption.selected = true;
                selectedType.replaceChild(newOption, op0);
                selectedType.removeChild(op2);
                break;
            case 3:
                newOption = op3.cloneNode(true);
                newOption.selected = true;
                selectedType.replaceChild(newOption, op0);
                selectedType.removeChild(op3);
                break;
            case 4:
                newOption = op4.cloneNode(true);
                newOption.selected = true;
                selectedType.replaceChild(newOption, op0);
                selectedType.removeChild(op4);
                break;
            case 5:
                newOption = op5.cloneNode(true);
                newOption.selected = true;
                selectedType.replaceChild(newOption, op0);
                selectedType.removeChild(op5);
                break;
            case 6:
                newOption = op6.cloneNode(true);
                newOption.selected = true;
                selectedType.replaceChild(newOption, op0);
                selectedType.removeChild(op6);
                break;
        }
    }
    
    
</script>

@if(is_null($proposal))

<div class="panel panel-default">
                <div class="panel-heading">Create proposal</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('createProposal', ['id' => $offer->id]) }}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Type</label>

                            <div class="col-md-6">
                                <select  id="type" class="form-control" name="type" autofocus>
                                    <option id="typeOption0" value="0">--All types--</option>
                                    <option id="typeOption1" value="1">Just cooperate</option>
                                    <option id="typeOption6" value="2">Curricular practice</option>
                                </select>

                                @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div id="description_div" class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" autofocus>

                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="scheduleAvailable_div" class="form-group{{ $errors->has('scheduleAvailable') ? ' has-error' : '' }}">
                            <label for="scheduleAvailable" class="col-md-4 control-label">scheduleAvailable</label>

                            <div class="col-md-6">
                                <input id="scheduleAvailable" type="text" class="form-control" name="scheduleAvailable" value="{{ old('scheduleAvailable') }}" autofocus>

                                @if ($errors->has('scheduleAvailable'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('scheduleAvailable') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="totalHours_div" class="form-group{{ $errors->has('totalHours') ? ' has-error' : '' }}">
                            <label for="totalHours" class="col-md-4 control-label">totalHours</label>

                            <div class="col-md-6">
                                <input id="totalHours" type="text" class="form-control" name="totalHours" value="{{ old('totalHours') }}" autofocus>

                                @if ($errors->has('totalHours'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('totalHours') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="earliestStartDate_div" class="form-group{{ $errors->has('earliestStartDate') ? ' has-error' : '' }}">
                            <label for="earliestStartDate" class="col-md-4 control-label">earliestStartDate</label>

                            <div class="col-md-6">
                                <input id="earliestStartDate" type="text" class="form-control" name="earliestStartDate" value="{{ old('earliestStartDate') }}" autofocus>

                                @if ($errors->has('earliestStartDate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('earliestStartDate') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div id="latestEndDate_div" class="form-group{{ $errors->has('latestEndDate') ? ' has-error' : '' }}">
                            <label for="latestEndDate" class="col-md-4 control-label">latestEndDate</label>

                            <div class="col-md-6">
                                <input id="latestEndDate" type="text" class="form-control" name="latestEndDate" value="{{ old('latestEndDate') }}" autofocus>

                                @if ($errors->has('latestEndDate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('latestEndDate') }}</strong>
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
                                <a data-toggle="collapse" href="#collapseProposal">Your proposal - {{$proposal->getStateName()}}</a>
                            </h4>
                        </div>
                    <div id="collapseProposal" class="panel-collapse collapse">
                    <ul class="list-group">
                        <li class="list-group-item ">type: {{$proposal->type}}</li>
                        <li class="list-group-item">description: {{$proposal->description}}</li>
                        <li class="list-group-item">scheduleAvailable: {{$proposal->scheduleAvailable}}</li>
                        <li class="list-group-item">totalHours: {{$proposal->totalHours}}</li>
                        <li class="list-group-item">earliestStartDate: {{$proposal->earliestStartDate}}</li>
                        <li class="list-group-item">latestEndDate: {{$proposal->latestEndDate}}</li>
                        <li class="list-group-item">state: {{$proposal->state}}</li>
                        <li class="list-group-item">creationDate: {{$proposal->creationDate}}</li>
                        <li class="list-group-item">skills: {{$proposal->student->skills}}</li>
                        <li class="list-group-item">areasOfInterest: {{$proposal->student->areasOfInterest}}</li>
                        <li class="list-group-item">study: {{$proposal->student->study->name}}</li>
                        <li class="list-group-item">urlCurriculum: {{$proposal->student->urlCurriculum}}</li>
                        <li class="list-group-item">phone: {{$proposal->student->user->phone}}</li>
                        <li class="list-group-item">email: {{$proposal->student->user->email}}</li>
                    </ul>
                    </div>
                    <div class="panel-footer">
                        <form>
                                {{ csrf_field() }}
                                <div class="btn-group">
                                    @if($proposal->state == 1)
                                    <button class="btn btn-warning" type="submit" formmethod="POST" formaction="{{route('removeProposal', ['id'=> $proposal->id])}}">Remove</button>
                                    @endif
                                    @if($proposal->state <= 2)
                                    <!-- Trigger the modal to accept the offer -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCancel">Cancel</button>
                                    @endif
                                    @if($proposal->state == 2)
                                    <!-- Trigger the modal to accept the offer -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAccept">Accept</button>
                                    @endif
                                    @if($proposal->state == 4)
                                    <!-- Trigger the modal to create project -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreateProject">Create project proposal from offer</button>
                                    @endif
                                </div>
                            </form>
                    </div>
                </div>
            </div>
@endif

<script>
       updateSelectedType({{ old('type')?old('type'):0 }});                     
</script>

@endsection



@if(!is_null($proposal))
<!-- Modal to create a project proposal-->
<div id="modalCreateProject" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter data of project</h4>
      </div>
      <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('createProjectProposal', ['id'=> $proposal->id]) }}">
                            {{ csrf_field() }}
                        
                        <div id="title_div" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title')}}" autofocus required>

                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                            
                            <div id="description_div" class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" autofocus required>

                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                        Create project proposal
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


@if(!is_null($proposal))
<!-- Modal to accept offer-->
<div id="modalAccept" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter data of project</h4>
      </div>
      <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('acceptProposal', ['id'=> $proposal->id]) }}">
                            {{ csrf_field() }}
                       
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                        Accept
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

@if(!is_null($proposal))
<!-- Modal to cancel proposal-->
<div id="modalCancel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter data of project</h4>
      </div>
      <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('cancelProposal', ['id'=> $proposal->id]) }}">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-danger">
                                        Cancel
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
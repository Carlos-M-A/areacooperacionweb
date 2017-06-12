@extends('layouts.app')

@section('content')


<script>
    
    // Global variables

    //Studies selected by the teacher
    var studiesSelectedByTeacher = [];
    //Studies names of all 
    var namesOfStudies = [];
    namesOfStudies[0] = '--Select--';
    @php
            $studiesList = App\Study::where('inactive', '=', '0') -> get();
    @endphp

    @foreach($studiesList as $element)
            namesOfStudies[{{$element -> id}}] = '{{$element->name}} - {{App\Campus::find($element->campus_id)->abbreviation}}';
    @endforeach
    
    /**
     * Initialize the data and fields required
     * Must be called when initializing the page
     */
    function initializes(){
        updateStudyOfStudent();
    }

    /*
     * When reload the page, this function update the study selected by the 
     * student in the 'select' field (html item)
     */
    function updateStudyOfStudent(){
        @if($user->role == 1)
            studyID = {{old('study') ? old('study') : $roleData->study_id}};
        @else
            studyID = {{old('study') ? old('study') : 0}};
        @endif
       
        if (studyID != 0){
            oldOption = document.getElementById('studyOption');
            //The new option (the option selected) is created
            study = document.getElementById('study');
            newOption = document.createElement('OPTION');
            newOption.value = studyID;
            text = document.createTextNode(namesOfStudies[studyID]);
            newOption.appendChild(text);
            newOption.selected = true;
            //Default option is replaced by new option
            study.replaceChild(newOption, oldOption);
        }
    }
</script>

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



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">@lang('general.edit')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('editProfile') }}">
                        {{ csrf_field() }}

                        <div id="name_div" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name')? old('name') : $user->name}}" autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        
                        <div id="surnames_div" class="form-group{{ $errors->has('surnames') ? ' has-error' : '' }}">
                            @if($user->role < 3 || $user->role == 6)
                                <label for="surnames" class="col-md-4 control-label">@lang('models.surnames')</label>
                            @else
                                <label for="surnames" class="col-md-4 control-label">@lang('models.socialName')</label>
                            @endif
                            <div class="col-md-6">
                                <input id="surnames" type="text" class="form-control" name="surnames" value="{{ old('surnames')? old('surnames') : $user->surnames }}" autofocus>

                                @if ($errors->has('surnames'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('surnames') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div id="email_div" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email')? old('email') : $user->email }}" >

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div id="idCard_div" class="form-group{{ $errors->has('idCard') ? ' has-error' : '' }}">
                            <label for="idCard" class="col-md-4 control-label">idCard</label>

                            <div class="col-md-6">
                                <input id="idCard" type="text" class="form-control" name="idCard" value="{{ old('idCard')? old('idCard') : $user->idCard }}" >

                                @if ($errors->has('idCard'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('idCard') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div id="phone_div" class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone')? old('phone') : $user->phone }}" >

                                @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        @if($role==1)
                        <div id="study_div" class="form-group{{ $errors->has('study') ? ' has-error' : '' }}">
                            <label for="study" class="col-md-4 control-label">Studys</label>

                            <div class="col-md-6">
                                <select  id="study" class="form-control" name="study" value="{{ old('study')? old('study') : $roleData->study }}"  autofocus>
                                    <option id="studyOption" value="0">-- Choose a study --</option>


                                    @foreach($studiesList as $elemento)
                                    <option value="{{$elemento->id}}" > {{$elemento->name}} - {{App\Campus::find($elemento->campus_id)->abbreviation}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('study'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('study') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        @if($role<=3)
                        <div id="areasOfInterest_div" class="form-group{{ $errors->has('areasOfInterest') ? ' has-error' : '' }}">
                            <label for="areasOfInterest" class="col-md-4 control-label">areasOfInterest</label>

                            <div class="col-md-6">
                                <textarea id="areasOfInterest" cols="200" rows="7" maxlength="{{config('forms.areasOfInterest')}}"
                                           class="form-control" name="areasOfInterest" autofocus>{{ old('areasOfInterest')?old('areasOfInterest') : $roleData->areasOfInterest }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('areasOfInterest'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('areasOfInterest') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($role==1)
                        <div id="skills_div" class="form-group{{ $errors->has('skills') ? ' has-error' : '' }}">
                            <label for="skills" class="col-md-4 control-label">skills</label>

                            <div class="col-md-6">
                                <textarea id="skills" cols="200" rows="7" maxlength="{{config('forms.skills')}}"
                                           class="form-control" name="skills" autofocus>{{ old('skills')?old('skills') : $roleData->skills }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('skills'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('skills') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($role==2)
                        <div id="departments_div" class="form-group{{ $errors->has('departments') ? ' has-error' : '' }}">
                            <label for="departments" class="col-md-4 control-label">departments</label>

                            <div class="col-md-6">
                                <textarea id="departments" cols="200" rows="7" maxlength="{{config('forms.departments')}}"
                                           class="form-control" name="departments" autofocus>{{ old('departments')?old('departments') : $roleData->departments }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('departments'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('departments') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($role==3 || $role==4 || $role==5)
                        <div id="description_div" class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">description</label>

                            <div class="col-md-6">
                                <textarea id="description" cols="200" rows="7" maxlength="{{config('forms.user_description')}}"
                                           class="form-control" name="description" autofocus>{{ old('description')?old('description') : $roleData->description }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($role==4 || $role==5)
                        <div id="headquartersLocation_div" class="form-group{{ $errors->has('headquartersLocation') ? ' has-error' : '' }}">
                            <label for="headquartersLocation" class="col-md-4 control-label">headquartersLocation</label>

                            <div class="col-md-6">
                                <textarea id="headquartersLocation" cols="200" rows="7" maxlength="{{config('forms.headquartersLocation')}}"
                                           class="form-control" name="headquartersLocation" autofocus>{{ old('headquartersLocation')?old('headquartersLocation') : $roleData->headquartersLocation }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('headquartersLocation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('headquartersLocation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($role==4 || $role==5)
                        <div id="web_div" class="form-group{{ $errors->has('web') ? ' has-error' : '' }}">
                            <label for="web" class="col-md-4 control-label">web</label>

                            <div class="col-md-6">
                                <input id="web" type="url" class="form-control" name="web" value="{{ old('web')? old('web') : $roleData->web }}" >

                                @if ($errors->has('web'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('web') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($role==4 || $role==5)
                        <div id="linksWithNearbyEntities_div" class="form-group{{ $errors->has('linksWithNearbyEntities') ? ' has-error' : '' }}">
                            <label for="linksWithNearbyEntities" class="col-md-4 control-label">linksWithNearbyEntities</label>

                            <div class="col-md-6">
                                <textarea id="linksWithNearbyEntities" cols="200" rows="7" maxlength="{{config('forms.linksWithNearbyEntities')}}"
                                           class="form-control" name="linksWithNearbyEntities" autofocus>{{ old('linksWithNearbyEntities')?old('linksWithNearbyEntities') : $roleData->linksWithNearbyEntities }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('linksWithNearbyEntities'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('linksWithNearbyEntities') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('general.save')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!--
     initializes function is called when the page is complety loaded 
-->

<script>
    initializes();
    //$(document).ready(initializes());
</script>
@endsection

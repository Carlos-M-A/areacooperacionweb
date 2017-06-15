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
        role = {{old('role') ? old('role') : 5}};
        
        changeRole(role, false, false);
        updateSelectedRole(role, false);
        updateStudyOfStudent();
        
        studiesSelectedByTeacherPreviously = {{old('teachingStudiesSelected') ? ('['.old('teachingStudiesSelected').']') : '[]'}};
        var study;
        for (study in studiesSelectedByTeacherPreviously){
            newStudy(studiesSelectedByTeacherPreviously[study]);
        }
    }
            
    /**
    * This function is called when reload the page to the form renember the chosen rol.
    * Update the role (It is changed for the selected rol above)
    */
    function updateSelectedRole(role, thereAreOrganizationFields){
        var selectedRole = document.getElementById('role');
        op1 = document.getElementById('roleOption1');
        op2 = document.getElementById('roleOption2');
        op3 = document.getElementById('roleOption3');
        if(thereAreOrganizationFields){
            op4 = document.getElementById('roleOption4');
        }
        op5 = document.getElementById('roleOption5');
        switch (role){
            case 5:
            case 1:
                newOption = op1.cloneNode(true);
                newOption.selected = true;
                selectedRole.replaceChild(newOption, op5);
                selectedRole.removeChild(op1);
                break;
            case 2:
                newOption = op2.cloneNode(true);
                newOption.selected = true;
                selectedRole.replaceChild(newOption, op5);
                selectedRole.removeChild(op2);
                break;
            case 3:
                newOption = op3.cloneNode(true);
                newOption.selected = true;
                selectedRole.replaceChild(newOption, op5);
                selectedRole.removeChild(op3);
                break;
            case 4:
                newOption = op4.cloneNode(true);
                newOption.selected = true;
                selectedRole.replaceChild(newOption, op5);
                selectedRole.removeChild(op4);
                break;
        }
    }
    
    /*
     * When reload the page, this function update the study selected by the 
     * student in the 'select' field (html item)
     */
    function updateStudyOfStudent(){
        //For the field about the study selected by the stundent
        studyID = {{old('study') ? old('study') : 0}};
        if (studyID != 0){
            oldOption = document.getElementById('opcionStudy');
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
    /**
     *  The new study is marked as other study selected by the theacher.
     *  This function is used to add studies to the studies teaching by teacher.
     *  Besides show the new selected study as a new 'checkbox'
     */
    function newStudy(id) {
        
        if (id == 0){
            id = parseInt(document.getElementById('teachingStudies').value);
        }
        //The first element of the 'select' should not be inserted
        if (id == 0){
            return;
        }
        name = namesOfStudies[id];
        //The study is not inserted if It is already selected.
        if (studiesSelectedByTeacher.indexOf(id) != -1){
            return;
        }
        //Add the new study and a new checkbox with the study name is created and shown
        studiesSelectedByTeacher.push(id);
        checkBoxes = document.getElementById('checkBoxes');
        document.getElementById('teachingStudiesSelected').value = studiesSelectedByTeacher.toString();
        //Elements created
        falseCheckBox = document.createElement('DIV');
        falseCheckBox.appendChild(document.createElement('LABEL'));
        falseCheckBox.firstChild.appendChild(document.createElement('INPUT'));
        //Values are given to the attributes of the elements
        //The checkboxes are named 'false' because only are used to show information
        falseCheckBox.id = 'falseCheckBox';
        falseCheckBox.type = 'checkbox';
        falseCheckBox.firstChild.firstChild.id = "falseTeachingStudies";
        falseCheckBox.firstChild.firstChild.type = "checkbox";
        falseCheckBox.firstChild.firstChild.name = "teachingStudiesSelectedEjemplo";
        falseCheckBox.firstChild.firstChild.checked = "checked";
        falseCheckBox.firstChild.firstChild.disabled = "disabled";
        text = document.createTextNode(name);
        falseCheckBox.firstChild.appendChild(text);
        //The chexbox is inserted in checkboxes group
        checkBoxes.appendChild(falseCheckBox);
    }

    /**
     * Change the fields of the page that are visibles according the role chosen
     * by the user. Thus the user only can see the fields required.
     */
    function changeRole(role, thereAreOrganizationFields, thereIsSurnamesField) {
        if (role == 0){
            role = parseInt(document.getElementById('role').value);
        }
        if(thereIsSurnamesField){
            surnamesDiv = document.getElementById('surnames_div');
        }
        
        areasOfInterestDiv = document.getElementById('areasOfInterest_div').style;
        skillsDiv = document.getElementById('skills_div').style;
        departmentsDiv = document.getElementById('departments_div').style;
        descriptionDiv = document.getElementById('description_div').style;
        studyDiv = document.getElementById('study_div').style;
        teachingStudiesDiv = document.getElementById('teachingStudies_div').style;
        teachingStudiesSelectedDiv = document.getElementById('teachingStudiesSelected_div').style;
        
        if(thereAreOrganizationFields){
            socialNameDiv = document.getElementById('socialName_div').style;
            headquartersLocationDiv = document.getElementById('headquartersLocation_div').style;
            webDiv = document.getElementById('web_div').style;
            linksWithNearbyEntitiesDiv = document.getElementById('linksWithNearbyEntities_div').style;
        }
        switch (role) {
            case 5:
            case 1:
                if(thereIsSurnamesField){
                    surnamesDiv.style.display = 'block';
                }
                areasOfInterestDiv.display = 'block';
                skillsDiv.display = 'block';
                departmentsDiv.display = 'none';
                descriptionDiv.display = 'none';
                studyDiv.display = 'block';
                teachingStudiesDiv.display = 'none';
                teachingStudiesSelectedDiv.display = 'none';
                if(thereAreOrganizationFields){
                    socialNameDiv.display = 'none';
                    headquartersLocationDiv.display = 'none';
                    webDiv.display = 'none';
                    linksWithNearbyEntitiesDiv.display = 'none';
                }
                break;
            case 2:
                if(thereIsSurnamesField){
                    surnamesDiv.style.display = 'block';
                }
                areasOfInterestDiv.display = 'block';
                skillsDiv.display = 'none';
                departmentsDiv.display = 'block';
                descriptionDiv.display = 'none';
                studyDiv.display = 'none';
                teachingStudiesDiv.display = 'block';
                teachingStudiesSelectedDiv.display = 'block';
                if(thereAreOrganizationFields){
                    socialNameDiv.display = 'none';
                    headquartersLocationDiv.display = 'none';
                    webDiv.display = 'none';
                    linksWithNearbyEntitiesDiv.display = 'none';
                }
                break;
            case 3:
                if(thereIsSurnamesField){
                    surnamesDiv.style.display = 'block';
                }
                areasOfInterestDiv.display = 'block';
                skillsDiv.display = 'none';
                departmentsDiv.display = 'none';
                descriptionDiv.display = 'block';
                studyDiv.display = 'none';
                teachingStudiesDiv.display = 'none';
                teachingStudiesSelectedDiv.display = 'none';
                if(thereAreOrganizationFields){
                    socialNameDiv.display = 'none';
                    headquartersLocationDiv.display = 'none';
                    webDiv.display = 'none';
                    linksWithNearbyEntitiesDiv.display = 'none';
                }
                break;
            case 4:
                if(thereIsSurnamesField){
                    surnamesDiv.style.display = 'none';
                }
                areasOfInterestDiv.display = 'none';
                skillsDiv.display = 'none';
                departmentsDiv.display = 'none';
                descriptionDiv.display = 'block';
                studyDiv.display = 'none';
                teachingStudiesDiv.display = 'none';
                teachingStudiesSelectedDiv.display = 'none';
                if(thereAreOrganizationFields){
                    socialNameDiv.display = 'block';
                    headquartersLocationDiv.display = 'block';
                    webDiv.display = 'block';
                    linksWithNearbyEntitiesDiv.display = 'block';
                }
                break;
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
                <div class="panel-heading">@lang('general.change_role')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('createRoleChangeRequest') }}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label">@lang('general.user_type')</label>

                            <div class="col-md-6">
                                <select  id="role" class="form-control" name="role" onchange="changeRole(0, false, false)" autofocus>
                                    
                                    <option id="roleOption5" value="5">--Change a type --</option>
                                    @if(Auth::user()->role!=1)
                                    <option id="roleOption1" value="1" onclick="changeRole(1, false, false)" onkeyup="changeRole(1, false, false)">Student UVa</option>
                                    @endif
                                    @if(Auth::user()->role!=2)
                                    <option id="roleOption2" value="2" onclick="changeRole(2, false, false)" onkeyup="changeRole(2, false, false)">Teacher UVa</option>
                                    @endif
                                    @if(Auth::user()->role!=3)
                                    <option id="roleOption3" value="3" onclick="changeRole(3, false, false)" onkeyup="changeRole(3, false, false)" >Other</option>
                                    @endif
                                </select>

                                @if ($errors->has('role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>



                       <div id="study_div" class="form-group{{ $errors->has('study') ? ' has-error' : '' }}">
                            <label for="study" class="col-md-4 control-label">@lang('models.Study')</label>

                            <div class="col-md-6">
                                <select  id="study" class="form-control" name="study" value="{{ old('study') }}"  autofocus>
                                    <option id="opcionStudy" value="0">-- Choose a study --</option>

                                    @foreach($studiesList as $element)
                                    <option value="{{$element->id}}" > {{$element->name}} - {{App\Campus::find($element->campus_id)->abbreviation}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('study'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('study') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                         <div id="teachingStudies_div" name="teachingStudies_div" class="form-group{{ $errors->has('teachingStudies') ? ' has-error' : '' }}">
                            <label for="teachingStudies" class="col-md-4 control-label">@lang('general.studies_with_teaching')</label>

                            <div class="col-md-6">
                                <select  id="teachingStudies" class="form-control" onchange="newStudy(0)" name="teachingStudies" value="{{ old('teachingStudies') }}" autofocus>
                                    <option value="0">-- Choose a study --</option>
                                    

                                    @foreach($studiesList as $element)
                                    <option value="{{$element->id}}" 
                                            onclick="newStudy({{$element->id}})"> 
                                        {{$element->name}} - {{App\Campus::find($element->campus_id)->abbreviation}}
                                    </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('teachingStudies'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('teachingStudies') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div id="teachingStudiesSelected_div" class="form-group{{ $errors->has('teachingStudiesSelected') ? ' has-error' : '' }}">
                            <label for="teachingStudiesSelected" class="col-md-4 control-label">@lang('general.selected_studies_with_teaching')</label>

                            <div id='checkBoxes' class="col-md-6">
                                <input id="teachingStudiesSelected"  type="checkbox" name="teachingStudiesSelected" value="" hidden="hidden" checked>

                                @if ($errors->has('teachingStudiesSelected'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('teachingStudiesSelected') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>



                        <div id="areasOfInterest_div" class="form-group{{ $errors->has('areasOfInterest') ? ' has-error' : '' }}">
                            <label for="areasOfInterest" class="col-md-4 control-label">@lang('models.areasOfInterest')</label>

                            <div class="col-md-6">
                                <textarea id="areasOfInterest" cols="100" rows="7" maxlength="{{config('forms.areasOfInterest')}}"
                                           class="form-control" name="areasOfInterest" autofocus>{{ old('areasOfInterest') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('areasOfInterest'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('areasOfInterest') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div id="skills_div" class="form-group{{ $errors->has('skills') ? ' has-error' : '' }}">
                            <label for="skills" class="col-md-4 control-label">@lang('models.skills')</label>

                            <div class="col-md-6">
                                <textarea id="skills" cols="100" rows="7" maxlength="{{config('forms.skills')}}"
                                           class="form-control" name="skills" autofocus>{{ old('skills') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('skills'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('skills') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div id="departments_div" class="form-group{{ $errors->has('departments') ? ' has-error' : '' }}">
                            <label for="departments" class="col-md-4 control-label">@lang('models.departments')</label>

                            <div class="col-md-6">
                                <textarea id="departments" cols="100" rows="7" maxlength="{{config('forms.departments')}}"
                                           class="form-control" name="departments" autofocus>{{ old('departments') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('departments'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('departments') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div id="description_div" class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">@lang('models.description')</label>

                            <div class="col-md-6">
                                <textarea id="description" cols="100" rows="7" maxlength="{{config('forms.user_description')}}"
                                           class="form-control" name="description" autofocus>{{ old('description') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('general.register')
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

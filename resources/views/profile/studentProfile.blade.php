@php
    $student = App\Student::find(Auth::user()->id);
    $study = App\Study::find($student->study_id);
    $faculty = App\Faculty::find($study->faculty_id);
@endphp

@extends('profile.profile')

@section('secondary_name')
<tr>
    <td>Apellidos</td>
    <td>{{$student->surnames}}</td>
</tr>
@endsection


@section('role_data')
<tr>
    <td>areaOfInterest</td>
    <td>{{$student->areasOfInterest}}</td>
</tr>
<tr>
    <td>skills</td>
    <td>{{$student->skills}}</td>
</tr>
<tr>
    <td>urlCurriculum</td>
    <td>{{$student->urlCurriculum}}</td>
</tr>
<tr>
    <td>curriculum</td>
    <td><a href="{{URL::asset($student->urlCurriculum)}}">Curriculum</a></td>
</tr>
<tr>
    <td>Study</td>
    <td>{{$study->name}}</td>
</tr>
<tr>
    <td> Faculty</td>
    <td>{{$faculty->name}} - {{$faculty->city}}</td>
</tr>
@endsection

@section('curriculum_student')
<div class="panel panel-primary">
    <div class="panel-heading">Curriculum</div>

    <div class="panel-body">
        @if(is_null($student->urlCurriculum))
            There isn't a curriculum yours 
        @else
            <a href="{{URL::asset($student->urlCurriculum)}}">Curriculum</a>
        @endif
    </div>
    <div class="panel-footer">
                        <!-- Trigger the modal to enter the tutor manually -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUploadCurriculum">upload</button>
    </div>
</div>


@endsection


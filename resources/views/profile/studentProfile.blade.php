@php
    $student = App\Student::find(Auth::user()->id);
    $study = App\Study::find($student->study_id);
    $campus = App\Campus::find($study->campus_id);
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
    <td>@if(is_null($student->urlCurriculum))
            There isn't a curriculum yours 
        @else
            <a href="{{URL::asset($student->urlCurriculum)}}">Curriculum</a>
        @endif</td>
</tr>
<tr>
    <td>Study</td>
    <td>{{$study->name}}</td>
</tr>
<tr>
    <td> Campus</td>
    <td>{{$campus->name}}</td>
</tr>
@endsection



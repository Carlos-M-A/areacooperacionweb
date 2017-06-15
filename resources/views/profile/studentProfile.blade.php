@php
    $student = App\Student::find(Auth::user()->id);
    $study = App\Study::find($student->study_id);
    $campus = App\Campus::find($study->campus_id);
@endphp

@extends('profile.profile')




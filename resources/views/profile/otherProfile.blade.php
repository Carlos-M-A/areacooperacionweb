@php
    $other = App\Other::find(Auth::user()->id);
@endphp

@extends('profile.profile')

@section('role_data')
<tr>
    <td>areaOfInterest</td>
    <td>{{$other->areasOfInterest}}</td>
</tr>
<tr>
    <td>Descripción</td>
    <td>{{$other->description}}</td>
</tr>
@endsection

@section('studies_teacher')

@endsection
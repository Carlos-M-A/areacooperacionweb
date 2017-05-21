@php
    $organization = App\Organization::find(Auth::user()->id);
@endphp

@extends('profile.profile')


@section('secondary_name')
<tr>
    <td>Social name</td>
    <td>{{$organization->socialName}}</td>
</tr>
@endsection

@section('role_data')
<tr>
    <td>Description</td>
    <td>{{$organization->description}}</td>
</tr>
<tr>
    <td>URL logo</td>
    <td>{{$organization->urlLogoImage}}</td>
</tr>
<tr>
    <td>headquarters location</td>
    <td>{{$organization->headquartersLocation}}</td>
</tr>
<tr>
    <td>Web</td>
    <td>{{$organization->web}}</td>
</tr>
<tr>
    <td> Links with nearby entities</td>
    <td>{{$organization->linksWithNearbyEntities}}</td>
</tr>
@endsection

@section('studies_teacher')

@endsection
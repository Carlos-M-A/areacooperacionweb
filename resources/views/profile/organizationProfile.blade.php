@php
    $organization = App\Organization::find(Auth::user()->id);
@endphp

@extends('profile.profile')


@extends('layouts.app')

@section('content')

@php
    $user = Auth::user();
@endphp



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if($user->role == 1)
                    <ul class="nav nav-tabs">
                        <li class=""><a href="{{ route('newOffers') }}">@lang('general.offers')</a></li>
                        <li class="active"><a href="{{ route('convocatories') }}">@lang('general.convocatories')</a></li>
                        <li class=""><a href="{{ route('myProjects') }}">@lang('general.projects')</a></li>
                    </ul>
                @endif
                @if($user->role == 5)
                    <ul class="nav nav-tabs">
                        <li class=""><a href="{{ route('myOffers') }}">@lang('general.offers')</a></li>
                        <li class="active"><a href="{{ route('convocatories') }}">@lang('general.convocatories')</a></li>
                        <li class=""><a href="{{ route('finishedProjects') }}">@lang('general.projects')</a></li>
                        <li class=""><a href="{{ route('searchUsers', ['role' => 0]) }}">@lang('general.users')</a></li>
                    </ul>
                @endif
            <div class="panel panel-info">
                <div class="panel-heading">
                    @lang('general.convocatories')
                    @if($user->role == 5)
                    <ul class="nav nav-pills">
                        <li class="active"><a href="{{ route('convocatories') }}">@lang('general.convocatories')</a></li>
                        <li class=""><a href="{{ route('showCreateConvocatory') }}">@lang('general.create_convocatory')</a></li>
                    </ul>
                    @endif
                </div>
                <div class="panel-body">
                    @foreach($convocatories as $convocatory)
                        <li class="list-group-item">
                            <div class="media-body">
                                <h4 class="media-heading"><a href="{{route('convocatory', ['id'=> $convocatory->id])}}" >{{$convocatory->title}}</a>
                                    @if($convocatory->state == 1)
                                    <span class="label label-success">@lang('enums.convocatory_state_' . $convocatory->state)</span>
                                    @elseif($convocatory->state == 2)
                                    <span class="label label-warning">@lang('enums.convocatory_state_' . $convocatory->state)</span>
                                    @elseif($convocatory->state == 3)
                                    <span class="label label-danger">@lang('enums.convocatory_state_' . $convocatory->state)</span>
                                    @endif
                                </h4>
                                <p>{{$convocatory->deadline}}</p>
                            </div>
                        </li>
                        @endforeach
                        
                        {{ $convocatories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

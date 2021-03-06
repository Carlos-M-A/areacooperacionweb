@extends('layouts.app')

@section('content')

@if($user->id != Auth::user()->id)
    @if(Auth::user()->role < 6)
    <ul class="pager">
        <li class="previous"><a href="{{ url()->previous() }}">@lang('pagination.previous')</a></li>
    </ul>
    @endif
    @if(Auth::user()->role == 6)
        @if($user->accepted)
        <ul class="pager">
            <li class="previous"><a href="{{ route('searchUsers', ['role' => 0]) }}">@lang('pagination.previous')</a></li>
        </ul>
        @else
        <ul class="pager">
            <li class="previous"><a href="{{ route('registrationRequests') }}">@lang('pagination.previous')</a></li>
        </ul>
        @endif
    @endif
@endif

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @yield('user_navigation_bar')
            <div class="panel panel-info">
                <div class="panel-heading">
                    <!-- Left-aligned -->
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($user->urlAvatar))
                                <a href="{{url($user->urlAvatar)}}" target="_blank">
                                    <img src="{{url($user->urlAvatar)}}" class="media-object img-circle img-thumbnail" style="width:60px;height:60px;">
                                </a>
                                
                                @else
                                <img src="{{URL::asset('images/avatar.jpg')}}" class="media-object img-circle img-thumbnail" style="width:60px;height:60px;">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a data-toggle="collapse" href="#collapseUser">{{$user->getNameAndSurnames()}}</a></h4>
                                <p>@lang('enums.role_' . $user->role)</p>
                            </div>
                        </div>
                </div>
                
                <div class="">
                    <ul class="nav nav-pills">
                        
                        @if(! $user->removed)
                            <li class=""><a href="mailto:{{$user->email}}">@lang('models.email')<span class="badge">{{$user->email}}</span></a></li>
                            @if(! is_null($user->phone))
                            <li class=""><a>@lang('models.phone')<span class="badge">{{$user->phone}}</span></a></li>
                            @endif
                            @if(Auth::user()->role > 4 || Auth::user()->id == $user->id)
                            <li class=""><a>@lang('general.registration_date')<span class="badge">{{$user->createdDate}}</span></a></li>
                            <li class=""><a>@lang('models.idCard')<span class="badge">{{$user->idCard}}</span></a></li>
                            @endif
                        @endif
                        
                        
                        @if($user->removed)
                       <li class=""><h1><span class="label label-danger">@lang('general.removed_user')</span></h1></li>
                        @endif
                        </ul>
                </div>
                
                <div class="text-center">
                    <a data-toggle="collapse" href="#collapseUser"><span class="glyphicon glyphicon-menu-down" style="font-size: 40px;"></span></a>
                </div>
                
                <div id="collapseUser" class="panel-collapse collapse">
                    <ul class="list-group">
                        @if($user->role == 1)
                            <li class="list-group-item"><b>@lang('models.study'):</b> {{$user->student->study->name}} - {{$user->student->study->campus->name}}</li>
                            @if(is_null($user->student->urlCurriculum))
                                <li class="list-group-item"><b>@lang('models.urlCurriculum'):</b> There isn't a curriculum</li>
                            @else
                                <li class="list-group-item"><b>@lang('models.urlCurriculum'):</b> <a href="{{url($user->student->urlCurriculum)}}" target="_blank">@lang('models.urlCurriculum')</a></li>
                            @endif
                            
                            <li class="list-group-item"><b>@lang('models.areasOfInterest'):</b> {{$user->student->areasOfInterest}}</li>
                            <li class="list-group-item"><b>@lang('models.skills'):</b> {{$user->student->skills}}</li>
                        @endif
                        @if($user->role == 2)
                            <li class="list-group-item"><b>@lang('general.studies'):</b> 
                                <ul>
                                @foreach($user->teacher->studies as $study)
                                <li> {{$study->name}} - {{$study->campus->name}}</li>
                                @endforeach
                                </ul>
                            </li>
                            <li class="list-group-item"><b>@lang('models.areasOfInterest'):</b> {{$user->teacher->areasOfInterest}}</li>
                            <li class="list-group-item"><b>@lang('models.departments'):</b> {{$user->teacher->departments}}</li>
                        @endif
                        @if($user->role == 3)
                            <li class="list-group-item"><b>@lang('models.areasOfInterest'):</b> {{$user->other->areasOfInterest}}</li>
                            <li class="list-group-item"><b>@lang('models.description'):</b> {{$user->other->description}}</li>
                        @endif
                        @if($user->role == 4 || $user->role == 5)
                            <li class="list-group-item"><b>@lang('models.socialName'):</b> {{$user->surnames}}</li>
                            <li class="list-group-item"><b>@lang('models.description'):</b> {{$user->organization->description}}</li>
                            <li class="list-group-item"><b>@lang('models.headquartersLocation'):</b> {{$user->organization->headquartersLocation}}</li>
                            <li class="list-group-item"><b>@lang('models.web'):</b> <a href="{{$user->organization->web}}" target="_blank">{{$user->name}}</a></li>
                            <li class="list-group-item"><b>@lang('models.linksWithNearbyEntities'):</b> {{$user->organization->linksWithNearbyEntities}}</li>
                            
                        @endif
                    </ul>
                </div>
                
                @yield('user_options')
                
            </div>

            @yield('more_content')


        </div>
    </div>
</div>
@endsection
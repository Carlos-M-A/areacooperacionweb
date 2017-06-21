@extends('layouts.app')

@section('content')


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
                                <img src="{{URL::asset($user->urlAvatar)}}" class="media-object" style="width:60px">
                                @else
                                <img src="{{url('images/avatar.jpg')}}" class="media-object" style="width:60px">
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
                        @if($user->removed)
                        <li class=""><h1><span class="label label-danger">@lang('general.removed_user')</span></h1></li>
                        @else
                            <li class=""><a href="mailto:{{$user->email}}">@lang('models.email')<span class="badge">{{$user->email}}</span></a></li>
                            <li class=""><a>@lang('models.phone')<span class="badge">{{$user->phone}}</span></a></li>
                        @endif
                        <li class=""><a>@lang('models.lastConnectionDate')<span class="badge">{{$user->lastConnectionDate}}</span></a></li>
                        </ul>
                </div>
                
                <div id="collapseUser" class="panel-collapse collapse">
                    <ul class="list-group">
                        @if($user->role == 1)
                            <li class="list-group-item"><b>@lang('models.study'):</b> {{$user->student->study->name}} - {{$user->student->study->campus->name}}</li>
                            @if(is_null($user->student->urlCurriculum))
                                <li class="list-group-item"><b>@lang('models.urlCurriculum'):</b> There isn't a curriculum</li>
                            @else
                                <li class="list-group-item"><b>@lang('models.urlCurriculum'):</b> <a href="{{url($user->student->urlCurriculum)}}">@lang('models.urlCurriculum')</a></li>
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
                            <li class="list-group-item"><b>@lang('models.web'):</b> <a href="{{$user->organization->web}}">{{$user->name}}</a></li>
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
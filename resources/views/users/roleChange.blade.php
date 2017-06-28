@extends('layouts.app')

@section('content')

<ul class="pager">
    <li class="previous"><a href="{{ url()->previous() }}">@lang('pagination.previous')</a></li>
</ul>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <!-- Left-aligned -->
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($roleChangeRequest->user->urlAvatar))
                                <img src="{{url($roleChangeRequest->user->urlAvatar)}}" class="media-object img-circle img-thumbnail" style="width:60px;height:60px;">
                                @else
                                <img src="{{URL::asset('images/avatar.jpg')}}" class="media-object img-circle img-thumbnail" style="width:60px;height:60px;">
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a data-toggle="collapse" href="#collapseUser">{{$roleChangeRequest->user->getNameAndSurnames()}}</a></h4>
                                <p>@lang('enums.role_' . $roleChangeRequest->user->role) <span class="glyphicon glyphicon-arrow-right"></span> @lang('enums.role_' . $roleChangeRequest->newRole)</p>
                            </div>
                        </div>
                </div>
                
                <div class="">
                    <ul class="nav nav-pills">
                        <li class=""><a href="{{route('user', ['id'=> $roleChangeRequest->user->id])}}" >{{$roleChangeRequest->user->getNameAndSurnames()}}</a></li>
                    </ul>
                </div>
                
                <div class="text-center">
                    <a data-toggle="collapse" href="#collapseUser"><span class="glyphicon glyphicon-menu-down" style="font-size: 40px;"></span></a>
                </div>
                
                <div id="collapseUser" class="panel-collapse collapse">
                    <ul class="list-group">
                        @if($roleChangeRequest->newRole == 1)
                            <li class="list-group-item"><b>@lang('models.study'):</b> {{$roleData->study->name}} - {{$roleData->study->campus->name}}</li>
                            @if(is_null($roleData->urlCurriculum))
                                <li class="list-group-item"><b>@lang('models.urlCurriculum'):</b> There isn't a curriculum</li>
                            @else
                                <li class="list-group-item"><b>@lang('models.urlCurriculum'):</b> <a href="{{url($roleData->urlCurriculum)}}">@lang('models.urlCurriculum')</a></li>
                            @endif
                            
                            <li class="list-group-item"><b>@lang('models.areasOfInterest'):</b> {{$roleData->areasOfInterest}}</li>
                            <li class="list-group-item"><b>@lang('models.skills'):</b> {{$roleData->skills}}</li>
                        @endif
                        @if($roleChangeRequest->newRole == 2)
                            <li class="list-group-item"><b>@lang('general.studies'):</b> 
                                <ul>
                                @foreach($roleData->studies as $study)
                                <li> {{$study->name}} - {{$study->campus->name}}</li>
                                @endforeach
                                </ul>
                            </li>
                            <li class="list-group-item"><b>@lang('models.areasOfInterest'):</b> {{$roleData->areasOfInterest}}</li>
                            <li class="list-group-item"><b>@lang('models.departments'):</b> {{$roleData->departments}}</li>
                        @endif
                        @if($roleChangeRequest->newRole == 3)
                            <li class="list-group-item"><b>@lang('models.areasOfInterest'):</b> {{$roleData->areasOfInterest}}</li>
                            <li class="list-group-item"><b>@lang('models.description'):</b> {{$roleData->description}}</li>
                        @endif
                    </ul>
                </div>
                

                
                <div class="panel-footer">
                    <form>
                        {{ csrf_field() }}
                        <button class="btn btn-success" formmethod="POST" formaction="{{route('acceptRoleChange', ['id'=> $roleChangeRequest->id])}}"
                                    data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.accept_role_change')"
                                    >@lang('general.accept')</button>
                            <button class="btn btn-danger" formmethod="POST" formaction="{{route('rejectRoleChange', ['id'=> $roleChangeRequest->id])}}"
                                    data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.reject_role_change')"
                                    >@lang('general.reject')</button>
                            
                    </form>

                </div>
            </div>


        </div>
    </div>
</div>
@endsection
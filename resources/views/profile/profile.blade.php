
@extends('users.user')

@section('user_navigation_bar')
@include('layouts.navigationBar', ['active' => 8])
@endsection

@section('user_options')
<div class="panel-footer">
    <form>
        {{ csrf_field() }}
        <button class="btn btn-primary" formmethod="GET" formaction="{{route('showEditProfile')}}">@lang('general.edit')</button>
        <button class="btn btn-warning" formmethod="GET" formaction="{{route('showEditPassword')}}">@lang('general.change_password')</button>
        <button class="btn btn-primary" formmethod="GET" formaction="{{route('showUploadAvatar', ['idUser' => $user->id])}}">@lang('general.upload_avatar')</button>
        @if($user->role==1)
        <button class="btn btn-primary" formmethod="GET" formaction="{{route('showUploadCurriculum', ['idUser' => $user->id])}}">@lang('general.upload_curriculum')</button>
        @endif
        @if($user->role<4)
        <button class="btn btn-warning" formmethod="GET" formaction="{{route('showCreateRoleChangeRequest')}}"
                data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.change_role')"
                >@lang('general.change_role')</button>
        @endif
        @if($user->role<=4)
        <button class="btn btn-danger" formmethod="POST" formaction="{{route('removeUser', ['id'=> $user->id])}}"
                data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.remove_my_user')"
                >@lang('general.remove_user')</button>
        @endif

    </form>
</div>
@endsection

@section('more_content')

            @yield('studies_teacher')
            
            @if($user->role<4)
            
            <div class="panel panel-info">
                <div class="panel-heading">@lang('general.observatory_name')</div>

                <div class="panel-body">
                    @if(!is_null($user->observatoryRequest))
                        @lang('general.did_a_request')
                    @else
                    {{$user->isObservatoryMember? __('general.is_member') : __('general.not_is_member')}}
                    @endif
                </div>
                <div class="panel-footer">
                    @if(!is_null($user->observatoryRequest))
                        <form action="{{route('removeObservatoryRequest')}}" method="post">
                                        {{ csrf_field() }}
                                        <button   
                                            type="submit" class="btn btn-warning">
                                                @lang('general.cancel_request')
                                        </button>
                                    </form>
                    @else
                        <form action="{{$user->isObservatoryMember? route('observatoryRemoveMember', ['id' => $user->id]) : route('createObservatoryRequest')}}" method="post">
                                        {{ csrf_field() }}
                                        <button   
                                            type="submit" class="btn {{$user->isObservatoryMember? 'btn-danger' : 'btn-success'}}"
                                            data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="{{$user->isObservatoryMember? __('confirmations.cancel_obs_member') : __('confirmations.request_obs_member')}}">
                                                {{$user->isObservatoryMember? __('general.cancel_obs_member') : __('general.request_obs_member')}}
                                        </button>
                                    </form>
                    @endif
                </div>
            </div>
            @endif
            
            <div class="panel panel-info">
                <div class="panel-heading">@lang('general.options')</div>

                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('general.option')</th>
                                <th>@lang('general.state')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>    
                                <td>@lang('general.notification_projects')</td>
                                <td>{{$user->notificationInfoProjects ? __('general.active') : __('general.inactive')}}</td>
                                <th>
                                    <form action="{{route('changeNotificationProjects')}}" method="post">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn {{$user->notificationInfoProjects ? 'btn-danger' : 'btn-success'}}">
                                                {{$user->notificationInfoProjects ? __('general.deactivate') : __('general.activate')}}
                                        </button>
                                    </form>
                                </th>
                            </tr>
                            <tr>
                                <td>@lang('general.notification_convocatories')</td>
                                <td>{{$user->notificationInfoConvocatories ? __('general.active') : __('general.inactive')}}</td>
                                <th>
                                    <form action="{{route('changeNotificationConvocations')}}" method="post">
                                        {{ csrf_field() }}
                                        <button   
                                            type="submit" class="btn {{$user->notificationInfoConvocatories ? 'btn-danger' : 'btn-success'}}">
                                                {{$user->notificationInfoConvocatories ? __('general.deactivate') : __('general.activate')}}
                                        </button>
                                    </form>
                                </th>
                            </tr>
                            
                            <tr>
                                <td>@lang('general.newsletter_subscription')</td>
                                <td>{{$user->isSubscriber? __('general.subscript') : __('general.not_subscript')}}</td>
                                <th>
                                    @if(config('app.newsletter_active'))
                                    <form action="{{route('changeSubscription')}}" method="post">
                                        {{ csrf_field() }}
                                        <button   
                                            type="submit" class="btn {{$user->isSubscriber ? 'btn-danger' : 'btn-success'}}">
                                                {{$user->isSubscriber ? __('general.cancel_subscription') : __('general.subscribe')}}
                                        </button>
                                    </form>
                                    @endif
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            
            
            
            
        </div>

    </div>
</div>
</div>

@endsection


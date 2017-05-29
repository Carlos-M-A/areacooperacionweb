@extends('layouts.app')

@section('content')

@php
    $user = Auth::user();
@endphp

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">@lang('general.profile_data')</div>

                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('general.field')</th>
                                <th>@lang('general.data')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Role</td>
                                <td>{{$user->getRoleName()}}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{$user->name}}</td>
                            </tr>
                            
                            @yield('secondary_name')
                            
                            <tr>
                                <td>Email</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <td>id card</td>
                                <td>{{$user->idCard}}</td>
                            </tr>
                            <tr>
                                <td>Phone number</td>
                                <td>{{$user->phone}}</td>
                            </tr>
                            
                            @yield('role_data')

                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <form>
                    <div class="btn-group">
                        <button class="btn btn-primary" formmethod="GET" formaction="{{route('showEditProfile')}}">@lang('general.edit')</button>
                        <button class="btn btn-primary" formmethod="GET" formaction="{{route('showEditPassword')}}">@lang('general.change_role')</button>
                        @if($user->role<4)
                        <button class="btn btn-primary" formmethod="GET" formaction="{{route('showRequestRoleChange')}}">@lang('general.change_password')</button>
                        @endif
                    </div>
                    </form>
                </div>
                    
            </div>

            
            @yield('estudios_docente')
            
            
            <div class="panel panel-primary">
                <div class="panel-heading">@lang('general.notifications')</div>

                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('general.notification')</th>
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
                                        <button type="submit" class="btn btn-primary">
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
                                            type="submit" class="btn btn-primary">
                                                {{$user->notificationInfoConvocatories ? __('general.deactivate') : __('general.activate')}}
                                        </button>
                                    </form>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-primary" >
                <div class="panel-heading">@lang('general.newsletter_subscription')</div>

                <div class="panel-body">
                    {{$user->isSubscriber? __('general.subscript') : __('general.not_subscript')}}
                </div>
                <div class="panel-footer">
                        <form action="{{route('changeSubscription')}}" method="post">
                                        {{ csrf_field() }}
                                        <button   
                                            type="submit" class="btn btn-primary">
                                                {{$user->isSubscriber? __('general.cancel_subscription') : __('general.subscribe')}}
                                        </button>
                                    </form>
                </div>
            </div>
            
            <div class="panel panel-primary">
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
                        <form action="{{route('removeBeObservatoryMember')}}" method="post">
                                        {{ csrf_field() }}
                                        <button   
                                            type="submit" class="btn btn-primary">
                                                @lang('general.cancell_request')
                                        </button>
                                    </form>
                    @else
                        <form action="{{$user->isObservatoryMember? route('removeBeObservatoryMember') : route('requestBeObservatoryMember')}}" method="post">
                                        {{ csrf_field() }}
                                        <button   
                                            type="submit" class="btn btn-primary">
                                                {{$user->isObservatoryMember? __('general.cancel_obs_member') : __('general.request_obs_member')}}
                                        </button>
                                    </form>
                    @endif
                </div>
            </div>
            
        </div>

    </div>
</div>
</div>
@endsection

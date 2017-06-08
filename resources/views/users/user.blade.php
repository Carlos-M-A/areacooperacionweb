@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">user data</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>field</th>
                                    <th>data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>accepted</td>
                                    <td>{{$user->accepted}}</td>
                                </tr>
                                <tr>
                                    <td>ID</td>
                                    <td>{{$user->id}}</td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>{{$user->getRoleName()}}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{$user->name}}</td>
                                </tr>

                                @yield('name_secundary')

                                <tr>
                                    <td>Email</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <td>idCard</td>
                                    <td>{{$user->idCard}}</td>
                                </tr>
                                <tr>
                                    <td>phone</td>
                                    <td>{{$user->phone}}</td>
                                </tr>
                                <tr>
                                    <td>Subscription</td>
                                    <td>{{$user->isSubscriber}}</td>
                                </tr>
                                <tr>
                                    <td>observatory member</td>
                                    <td>{{$user->isObservatoryMember}}</td>
                                </tr>
                                <tr>
                                    <td>Notification convocatories active</td>
                                    <td>{{$user->notificationInfoConvocatories}}</td>
                                </tr>
                                <tr>
                                    <td>Notification projects active</td>
                                    <td>{{$user->notificationInfoProjects}}</td>
                                </tr>
                                <tr>
                                    <td>last connection date</td>
                                    <td>{{$user->lastConnectionDate}}</td>
                                </tr>
                                <tr>
                                    <td>register date</td>
                                    <td>{{$user->createdDate}}</td>
                                </tr>
                                @yield('role_data')

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <form>
                        {{ csrf_field() }}
                    <div class="btn-group">
                        @if($user->accepted)
                            <button class="btn btn-primary" formmethod="POST" formaction="{{route('removeUser', ['id'=> $user->id])}}">@lang('general.remove')</button>
                            @if($user->role == 4)
                                <button class="btn btn-primary" formmethod="GET" formaction="{{route('showEditOrganization', ['id' => $user->id])}}">@lang('general.edit')</button>
                            @endif
                        @else
                            <button class="btn btn-primary" formmethod="POST" formaction="{{route('acceptUser', ['id'=> $user->id])}}">@lang('general.accept')</button>
                            <button class="btn btn-primary" formmethod="POST" formaction="{{route('rejectUser', ['id'=> $user->id])}}">@lang('general.reject')</button>
                        @endif
                        
                    </div>
                    </form>
                </div>
            </div>


            <div class="panel panel-primary">
                <div class="panel-heading">@lang('general.observatory_name')</div>

                <div class="panel-body">
                    @if(!is_null($user->observatoryRequest))
                        @lang('general.user_has_a_request')
                    @else
                        {{$user->isObservatoryMember? __('general.is_member') : __('general.not_is_member')}}
                    @endif
                </div>
                <div class="panel-footer">
                    @if(!is_null($user->observatoryRequest))
                    <form action="{{route('observatoryRejectRequest', ['id'=> $user->id])}}" method="post">
                        {{ csrf_field() }}
                        <button   
                            type="submit" class="btn btn-primary">
                            @lang('general.reject')
                        </button>
                    </form>
                    <form action="{{route('observatoryAcceptRequest', ['id'=> $user->id])}}" method="post">
                        {{ csrf_field() }}
                        <button   
                            type="submit" class="btn btn-primary">
                            @lang('general.accept')
                        </button>
                    </form>
                    @elseif($user->isObservatoryMember)
                    <form action="{{route('observatoryRemoveMember', ['id'=> $user->id])}}" method="post">
                        {{ csrf_field() }}
                        <button   
                            type="submit" class="btn btn-primary">
                            @lang('general.remove')
                        </button>
                    </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
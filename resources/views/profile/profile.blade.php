@extends('layouts.app')

@section('content')

@php
    $user = Auth::user();
@endphp

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Profile data</div>

                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Data</th>
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
                    
                        <form action="{{route('showEditProfile')}}" method="get">
                              <input class="btn btn-primary" type="submit" value="Editar">
                                </form>
                       
                    <form action="{{route('showEditPassword')}}" method="get">
                        <button class="btn btn-primary" type="submit">change password</button>
                                </form>
                    @if($user->role<4)
                              <form action="{{route('showRequestRoleChange')}}" method="get">
                                  <button class="btn btn-primary" type="submit">change role</button>
                                </form>
                    @endif
                    
                </div>
            </div>

            
            @yield('estudios_docente')
            
            
            <div class="panel panel-primary">
                <div class="panel-heading">Notifications active</div>

                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Notification</th>
                                <th>State</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Projects</td>
                                <td>{{$user->notificationInfoProjects? 'Actice' : 'Inactive'}}</td>
                                <th>
                                    <form action="{{route('changeNotificationProjects')}}" method="post">
                                        {{ csrf_field() }}
                                        <button   
                                            type="submit" class="btn btn-primary">
                                                {{$user->notificationInfoProjects? 'Deactivate' : 'Activate'}}
                                        </button>
                                    </form>
                                </th>
                            </tr>
                            <tr>
                                <td>Convocations</td>
                                <td>{{$user->notificationInfoConvocatories? 'Active' : 'Inactive'}}</td>
                                <th>
                                    <form action="{{route('changeNotificationConvocations')}}" method="post">
                                        {{ csrf_field() }}
                                        <button   
                                            type="submit" class="btn btn-primary">
                                                {{$user->notificationInfoConvocatories? 'Deactivate' : 'Activate'}}
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
                <div class="panel-heading">Newsletter Subscription</div>

                <div class="panel-body">
                    {{$user->isSubscriber? 'Subscript' : 'Not Subscript'}}
                </div>
                <div class="panel-footer">
                        <form action="{{route('changeSubscription')}}" method="post">
                                        {{ csrf_field() }}
                                        <button   
                                            type="submit" class="btn btn-primary">
                                                {{$user->isSubscriber? 'Cancel subscription' : 'Subscribe'}}
                                        </button>
                                    </form>
                </div>
            </div>
            
            <div class="panel panel-primary">
                <div class="panel-heading">Observatory of the cooperation for development of the UVa</div>

                <div class="panel-body">
                    @if(!is_null($user->observatoryRequest))
                        You did a request to be a observatory member
                    @else
                    {{$user->isObservatoryMember? 'Is member' : 'Not is member'}}
                    @endif
                </div>
                <div class="panel-footer">
                    @if(!is_null($user->observatoryRequest))
                        <form action="{{route('removeBeObservatoryMember')}}" method="post">
                                        {{ csrf_field() }}
                                        <button   
                                            type="submit" class="btn btn-primary">
                                                Cancel the request
                                        </button>
                                    </form>
                    @else
                        <form action="{{$user->isObservatoryMember? route('removeBeObservatoryMember') : route('requestBeObservatoryMember')}}" method="post">
                                        {{ csrf_field() }}
                                        <button   
                                            type="submit" class="btn btn-primary">
                                                {{$user->isObservatoryMember? 'Cancel be observatory member' : 'Request be observatory member'}}
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

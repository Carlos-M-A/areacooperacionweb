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
                    @if($user->accepted)
                    <form action="{{route('removeUser', ['id'=> $user->id])}}" method="post">
                        {{ csrf_field() }}
                        <button class="btn btn-primary" type="submit">Remove</button>
                    </form>
                    @else
                    <form action="{{route('acceptUser', ['id'=> $user->id])}}" method="post">
                        {{ csrf_field() }}
                        <button class="btn btn-primary" type="submit">Accept</button>
                    </form>
                    <form action="{{route('rejectUser', ['id'=> $user->id])}}" method="post">
                        {{ csrf_field() }}
                        <button class="btn btn-primary" type="submit">Reject</button>
                    </form>
                    @endif
                </div>
            </div>


            <div class="panel panel-primary">
                <div class="panel-heading">Observatory of the cooperation to development of the UVa</div>

                <div class="panel-body">
                    @if(!is_null($user->observatoryRequest))
                    The user has a request in the observatory
                    @else
                    {{$user->isObservatoryMember? 'Is member' : 'Not is member'}}
                    @endif
                </div>
                <div class="panel-footer">
                    @if(!is_null($user->observatoryRequest))
                    <form action="{{route('observatoryReject', ['id'=> $user->id])}}" method="post">
                        {{ csrf_field() }}
                        <button   
                            type="submit" class="btn btn-primary">
                            Reject request
                        </button>
                    </form>
                    <form action="{{route('observatoryAccept', ['id'=> $user->id])}}" method="post">
                        {{ csrf_field() }}
                        <button   
                            type="submit" class="btn btn-primary">
                            Accept request
                        </button>
                    </form>
                    @elseif($user->isObservatoryMember)
                    <form action="{{route('observatoryRemove', ['id'=> $user->id])}}" method="post">
                        {{ csrf_field() }}
                        <button   
                            type="submit" class="btn btn-primary">
                            Remove member
                        </button>
                    </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
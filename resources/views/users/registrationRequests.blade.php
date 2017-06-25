@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.navigationBar', ['active' => 5])
            <div class="panel panel-info">
                <div class="panel-heading">@lang('general.users')
                <ul class="nav nav-pills">
                        <li class=""><a href="{{ route('searchUsers', ['role' => 0]) }}">@lang('general.users')</a></li>
                        @if(Auth::user()->role == 6)
                        <li class="active"><a href="{{ route('registrationRequests') }}">@lang('general.registration_requests')</a></li>
                        <li class=""><a href="{{ route('roleChanges') }}">@lang('general.role_change_requests')</a></li>
                        <li class=""><a href="{{ route('showCreateOrganization') }}">@lang('general.register_organization')</a></li>
                        @endif
                    </ul>
                </div>

                <div class="panel-body">
                    @foreach($users as $user)
                        <li class="list-group-item">
                        <!-- Left-aligned -->
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($user->urlAvatar))
                                <img src="{{url($user->urlAvatar)}}" class="media-object img-circle img-thumbnail" style="width:60px;height:60px;">
                                @else
                                <img src="{{URL::asset('images/avatar.jpg')}}" class="media-object img-circle img-thumbnail" style="width:60px;height:60px;">
                                @endif
                                
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="{{route('user', ['id'=> $user->id])}}" >{{$user->getNameAndSurnames()}}</a></h4>
                                    <p>@lang('enums.role_' . $user->role)</p>
                            </div>
                        </div>
                        </li>
                        @endforeach
                <div class="panel-footer">
                    {{ $users->links() }}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
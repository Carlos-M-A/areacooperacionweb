@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.navigationBar', ['active' => 6])
            <div class="panel panel-info">
                <div class="panel-heading">
                    @lang('general.the_observatory')
                    <ul class="nav nav-pills">
                        @if(Auth::check() && Auth::user()->role == 6)
                        <li class="{{old('ask')==1 ? 'active' : ''}}"><a href="{{ route('observatory', ['ask' => 1]) }}">@lang('general.requests')<span class="badge">{{App\ObservatoryRequest::all()->count()}}</span></a></li>
                        @endif
                        <li class="{{old('ask')==2 ? 'active' : ''}}"><a href="{{ route('observatory', ['ask' => 2]) }}">@lang('general.members')<span class="badge">{{App\User::where('isObservatoryMember', true)->count()}}</span></a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    @foreach($users as $user)
                        <li class="list-group-item">
                        <!-- Left-aligned -->
                        <div class="media">
                            @if(Auth::check())
                                <div class="media-left">
                                    @if(!is_null($user->urlAvatar))
                                    <img src="{{url($user->urlAvatar)}}" class="media-object img-circle img-thumbnail" style="width:60px;height:60px;">
                                    @else
                                    <img src="{{URL::asset('images/avatar.jpg')}}" class="media-object img-circle img-thumbnail" style="width:60px;height:60px;">
                                    @endif
                                </div>
                            @endif
                            <div class="media-body">
                                @if(Auth::check())
                                    <h4 class="media-heading"><a href="{{route('user', ['id'=> $user->id])}}" >{{$user->getNameAndSurnames()}}</a></h4>
                                    <p>@lang('enums.role_' . $user->role)</p>
                                @else
                                    <h4 class="media-heading">{{$user->getNameAndSurnames()}}</h4>
                                @endif
                                    
                            </div>
                        </div>
                        </li>
                        @endforeach
                        {{ $users->appends(['ask' => old('ask')])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

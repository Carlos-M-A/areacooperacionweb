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
                        <li class="{{old('ask')==1 ? 'active' : ''}}"><a href="{{ route('observatory', ['ask' => 1]) }}">Requests<span class="badge">{{App\ObservatoryRequest::all()->count()}}</span></a></li>
                        <li class="{{old('ask')==2 ? 'active' : ''}}"><a href="{{ route('observatory', ['ask' => 2]) }}">Members<span class="badge">{{App\User::where('isObservatoryMember', true)->count()}}</span></a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    @foreach($users as $user)
                        <li class="list-group-item">
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
                                <h4 class="media-heading"><a href="{{route('user', ['id'=> $user->id])}}" >{{$user->getNameAndSurnames()}}</a></h4>
                                    <p>@lang('enums.role_' . $user->role)</p>
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

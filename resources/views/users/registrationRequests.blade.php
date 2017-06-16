@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> Registration requests </h1>
            
            
            <div class="panel panel-info">
                <div class="panel-heading">@lang('general.registration_requests')</div>

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
                <div class="panel-footer">
                    {{ $users->links() }}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
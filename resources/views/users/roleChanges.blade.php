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
                        <li class=""><a href="{{ route('registrationRequests') }}">@lang('general.registration_requests')</a></li>
                        <li class="active"><a href="{{ route('roleChanges') }}">@lang('general.role_change_requests')</a></li>
                        <li class=""><a href="{{ route('showCreateOrganization') }}">@lang('general.register_organization')</a></li>
                        @endif
                    </ul>
                </div>
                
                
                <div class="panel-body">
                    @foreach($requests as $request)
                        <li class="list-group-item">
                        <!-- Left-aligned -->
                        <div class="media">
                            <div class="media-left">
                                @if(!is_null($request->user->urlAvatar))
                                <img src="{{URL::asset($request->user->urlAvatar)}}" class="media-object" style="width:60px">
                                @else
                                <img src="{{url('images/avatar.jpg')}}" class="media-object" style="width:60px">
                                @endif
                                
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="{{route('roleChange', ['id'=> $request->id])}}" >{{$request->user->getNameAndSurnames()}}</a></h4>
                                    <p>@lang('enums.role_' . $request->user->role) <span class="glyphicon glyphicon-arrow-right"></span> @lang('enums.role_' . $request->newRole)</p>
                            </div>
                        </div>
                        </li>
                        @endforeach
                        {{ $requests->links() }}
                    </div>
                
            </div>
            
            
        </div>
    </div>
</div>
@endsection

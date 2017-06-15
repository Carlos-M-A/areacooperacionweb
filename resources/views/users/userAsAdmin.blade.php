@extends('users.user')

@section('user_options')
<div class="panel-footer">
    <form>
        {{ csrf_field() }}
    <div class="btn-group">
        @if($user->accepted)
            <button class="btn btn-danger" formmethod="POST" formaction="{{route('removeUser', ['id'=> $user->id])}}">@lang('general.remove')</button>
            @if($user->role == 4)
                <button class="btn btn-warning" formmethod="GET" formaction="{{route('showEditOrganization', ['id' => $user->id])}}">@lang('general.edit')</button>
                <button class="btn btn-warning" formmethod="GET" formaction="{{route('showUploadAvatar', ['idUser' => $user->id])}}">@lang('general.upload_avatar')</button>
            @endif
        @else
            <button class="btn btn-success" formmethod="POST" formaction="{{route('acceptUser', ['id'=> $user->id])}}">@lang('general.accept')</button>
            <button class="btn btn-danger" formmethod="POST" formaction="{{route('rejectUser', ['id'=> $user->id])}}">@lang('general.reject')</button>
        @endif
        
    </div>
    </form>
</div>
@endsection



@section('more_content')
<div class="panel panel-info">
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
@endsection
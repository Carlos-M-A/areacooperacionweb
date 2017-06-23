@extends('users.user')

@section('user_options')
<div class="panel-footer">
    <form>
        {{ csrf_field() }}
        @if($user->role < 5)
            @if($user->accepted)
                <button class="btn btn-danger" formmethod="POST" formaction="{{route('removeUser', ['id'=> $user->id])}}"
                        data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.remove_user')"
                        >@lang('general.remove')</button>
                @if($user->role == 4)
                    <button class="btn btn-warning" formmethod="GET" formaction="{{route('showEditOrganization', ['id' => $user->id])}}">@lang('general.edit')</button>
                    <button class="btn btn-warning" formmethod="GET" formaction="{{route('showUploadAvatar', ['idUser' => $user->id])}}">@lang('general.upload_avatar')</button>
                @endif
            @else
                <button class="btn btn-success" formmethod="POST" formaction="{{route('acceptUser', ['id'=> $user->id])}}">@lang('general.accept')</button>
                <button class="btn btn-danger" formmethod="POST" formaction="{{route('rejectUser', ['id'=> $user->id])}}"
                        data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.reject_user')"
                        >@lang('general.reject')</button>
            @endif
        @endif

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
        <form>
            {{ csrf_field() }}
            <div class="btn-group">
                @if(!is_null($user->observatoryRequest))
                <button class="btn btn-danger" formmethod="POST" formaction="{{route('observatoryRejectRequest', ['id'=> $user->id])}}">@lang('general.reject')</button>
                <button class="btn btn-success" formmethod="POST" formaction="{{route('observatoryAcceptRequest', ['id'=> $user->id])}}">@lang('general.accept')</button>
                @elseif($user->isObservatoryMember)
                <button class="btn btn-danger" formmethod="POST" formaction="{{route('observatoryRemoveMember', ['id'=> $user->id])}}"
                        data-toggle="confirmation" data-btn-ok-label="@lang('general.yes')"  data-btn-ok-class="btn-success" data-btn-cancel-label="@lang('general.no')"  data-btn-cancel-class="btn-danger" data-title="@lang('confirmations.remove_obervatory_member')"
                        >@lang('general.remove')</button>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
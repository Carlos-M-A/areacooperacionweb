
<ul class="nav nav-tabs">
    @if(Auth::check())
        @php
            $role = Auth::user()->role;
        @endphp
        @if($role == 1 || $role == 4 || $role == 5)
        <li class="{{($active == 1) ? 'active' : ''}}"><a href="{{ route('offers') }}">@lang('general.offers')</a></li>
        @endif
        @if($role == 1 || $role == 5)
        <li class="{{($active == 2) ? 'active' : ''}}"><a href="{{ route('convocatories') }}">@lang('general.convocatories')</a></li>
        @endif
        @if($role == 1 || $role == 2 || $role == 5)
        <li class="{{($active == 3) ? 'active' : ''}}"><a href="{{ route('projects') }}">@lang('general.projects')</a></li>
        @endif
        @if($role == 5 || $role == 6)
        <li class="{{($active == 5) ? 'active' : ''}}"><a href="{{ route('searchUsers', ['role' => 0]) }}">@lang('general.users')</a></li>
        @endif
        @if($role == 5 || $role == 6)
        <li class="{{($active == 6) ? 'active' : ''}}"><a href="{{ route('observatory', ['ask' => 2]) }}">@lang('general.the_observatory')</a></li>
        @endif
        @if($role == 6)
        <li class="{{($active == 7) ? 'active' : ''}}"><a href="{{ route('configuration') }}">@lang('general.configuration')</a></li>
        @endif
        <li class="{{($active == 8) ? 'active' : ''}}"><a href="{{ route('profile') }}">@lang('general.profile')</a></li>
    @else
        
    @endif
</ul>
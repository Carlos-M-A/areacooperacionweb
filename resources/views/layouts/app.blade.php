<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Area of Cooperation') }}</title>

    <!-- Styles -->
     <meta charset="utf-8">
    
     <!--To guarante that the screen looks good in mobile devices -->
     
     <meta name="viewport" content="width=device-width, initial-scale=1"> 
     
     
     
     <script src="{{ URL::asset('js/jquery-3.2.1.js') }}"></script>
     
     <link href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
     <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
     
     <script src="{{ URL::asset('js/bootstrap-confirmation.min.js') }}"></script>
     
     
      <!--With this, the web work perfectly, but the css and js would not be in own server
     
     <script type="text/javascript"  src="https://code.jquery.com/jquery-3.2.1.js"></script>
     
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"  media="screen">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    -->
        
    
    <!-- Scripts This script was in laravel original code. Delete if nothing fail
    <script src="{{ asset('js/app.js') }}"></script>-->
    
    
    
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    
   $( document ).ready(function() {
        
         $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            // other options
            });
    });
    </script>
    
    @yield('more_script')
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    @if (Auth::guest())
                    <a class="navbar-brand" href="{{ config('app.link_in_app_name', '/') }}">
                        {{ config('app.name', 'CooperationArea') }}
                    </a>
                    @else
                    <a class="navbar-brand" href="{{ config('app.link_in_app_name', '/') }}">
                        {{ config('app.name', 'CooperationArea') }}
                    </a>
                    @endif
                </div>
                
                

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">@lang('general.login')</a></li>
                            <li><a href="{{ route('register') }}">@lang('general.register')</a></li>
                            <li><a href="{{ route('finishedProjects') }}">@lang('general.projects')</a></li>
                            <li><a href="{{ route('observatory', ['ask' => 2]) }}">@lang('general.the_observatory')</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('profile') }}">
                                            @lang('general.profile')
                                        </a>
                                        
                                        <a href="{{URL::asset('files/manual.pdf')}}" target="_blank">
                                            @lang('general.help')
                                        </a>
                                        
                                        
                                        
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            @lang('general.logout')
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                    
                    
                </div>
            </div>
        </nav>

        
        
        @yield('content')
        
        
    </div>

    
    
</body>
</html>

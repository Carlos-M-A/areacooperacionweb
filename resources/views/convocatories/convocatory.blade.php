@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="media-body">
                        <h4 class="media-heading"><a data-toggle="collapse" href="#collapseConvocatory">{{$convocatory->title}}</a>
                            @if($convocatory->state == 1)
                            <span class="label label-success">@lang('enums.convocatory_state_' . $convocatory->state)</span>
                            @elseif($convocatory->state == 2)
                            <span class="label label-warning">@lang('enums.convocatory_state_' . $convocatory->state)</span>
                            @elseif($convocatory->state == 3)
                            <span class="label label-danger">@lang('enums.convocatory_state_' . $convocatory->state)</span>
                            @endif
                        </h4>
                        <p><a href='{{route('user', ['id' => 2])}}'>{{App\User::find(2)->name}}</a></p>
                    </div>
                </div>
                    <div class="">
                        <ul class="nav nav-pills">
                        <li class=""><a>@lang('models.deadline')<span class="badge">{{$convocatory->deadline}}</span></a></li>
                        <li class=""><a href="{{$convocatory->urlDocumentation}}">@lang('models.urlDocumentation')</a></li>
                        </ul>
                    </div>
                    <div id="collapseConvocatory" class="panel-collapse collapse">
                        <ul class="list-group">
                            <li class="list-group-item"><b>@lang('models.information'):</b> {{$convocatory->information}}</li>
                            <li class="list-group-item"><b>@lang('models.estimatedPeriod'):</b> {{$convocatory->estimatedPeriod}}</li>
                        </ul>
                </div>
                
                     @yield('convocatory_options')
                
            </div>
            @yield('convocatory_inscriptions')
                                
            @yield('inscription')
            
            
        </div>
    </div>
</div>


@endsection

@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="media-body">
                        <h4 class="media-heading"><a data-toggle="collapse" href="#collapseOffer">{{$project->title}}</a>
                                @if($project->state ==1)
                                    <span class="label label-success">@lang('enums.project_state_1')</span>
                                @elseif($project->state ==2)
                                    <span class="label label-warning">@lang('enums.project_state_2')</span>
                                @elseif($project->state ==3)
                                    <span class="label label-danger">@lang('enums.project_state_3')</span>
                                @endif
                                </h4>
                    </div>
                </div>
                    <div id="collapseOffer" class="panel-collapse collapse">
                        <ul class="list-group">
                            <li class="list-group-item"><b>@lang('models.study'):</b> {{$project->study->name}}</li>
                            <li class="list-group-item"><b>@lang('models.urlDocumentation'):</b> <a href="{{$project->urlDocumentation}}"><b>@lang('models.urlDocumentation')</b></a></li>
                            <li class="list-group-item"><b>@lang('models.scope'):</b> {{$project->scope}}</li>
                            <li class="list-group-item"><b>@lang('models.description'):</b> {{$project->description}}</li>
                            <li class="list-group-item"><b>@lang('models.author'):</b> {{$project->author}}</li>
                            <li class="list-group-item"><b>@lang('models.tutor'):</b> {{$project->tutor}}</li>
                            <li class="list-group-item"><b>@lang('models.finishedDate'):</b> {{$project->finishedDate}}</li>
                        </ul>
                </div>
                
                     @yield('project_options')
                
            </div>
            @yield('project_tutor')
            
            @yield('project_inscriptions')
                                
            @yield('student_inscription')
        </div>
    </div>
</div>


@endsection

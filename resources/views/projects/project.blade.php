@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapseOffer">{{$project->title}}</a>
                    </h4>
                </div>
                    <div id="collapseOffer" class="panel-collapse collapse">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>field</th>
                                    <th>data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>offer</td>
                                    <td><a href='{{route('offer', ['id' => $project->offer_id])}}'>{{$project->offer->title}}</a></td>
                                </tr>
                                <tr>
                                    <td>title</td>
                                    <td>{{$project->title}}</td>
                                </tr>
                                <tr>
                                    <td>scope</td>
                                    <td>{{$project->scope}}</td>
                                </tr>
                                <tr>
                                    <td>description</td>
                                    <td>{{$project->description}}</td>
                                </tr>
                                <tr>
                                    <td>type</td>
                                    <td>{{$project->type}}</td>
                                </tr>
                                <tr>
                                    <td>author</td>
                                    <td>{{$project->author}}</td>
                                </tr>
                                <tr>
                                    <td>tutor</td>
                                    <td>{{$project->tutor}}</td>
                                </tr>
                                <tr>
                                    <td>secondaryTutors</td>
                                    <td>{{$project->secondaryTutors}}</td>
                                </tr>
                                <tr>
                                    <td>year</td>
                                    <td>{{$project->year}}</td>
                                </tr>
                                <tr>
                                    <td>state</td>
                                    <td>{{$project->state}}</td>
                                </tr>
                                <tr>
                                    <td>urlDocumentation</td>
                                    <td>{{$project->urlDocumentation}}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                
                     @yield('project_options')
                
            </div>
            @yield('project_proposals')
                                
            @yield('teacher_proposal')
        </div>
    </div>
</div>


@endsection

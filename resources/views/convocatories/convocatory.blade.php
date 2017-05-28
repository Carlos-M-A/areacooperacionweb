@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapseOffer">{{$convocatory->title}}</a>
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
                                    <td>title</td>
                                    <td>{{$convocatory->title}}</td>
                                </tr>
                                <tr>
                                    <td>information</td>
                                    <td>{{$convocatory->information}}</td>
                                </tr>
                                <tr>
                                    <td>estimatedPeriod</td>
                                    <td>{{$convocatory->estimatedPeriod}}</td>
                                </tr>
                                <tr>
                                    <td>urlDocumentation</td>
                                    <td>{{$convocatory->urlDocumentation}}</td>
                                </tr>
                                <tr>
                                    <td>deadLine</td>
                                    <td>{{$convocatory->deadline}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                     @yield('convocatory_options')
                
            </div>
            @yield('convocatory_inscriptions')
                                
            @yield('inscription')
        </div>
    </div>
</div>


@endsection

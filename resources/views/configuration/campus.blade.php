@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> Campus </h1>
            
            <div class="panel panel-default">
                <div class="panel-heading">Campus</div>
                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Abbreviation</td>
                                <td>{{$campus->abbreviation}}</td>
                            </tr>
                            <tr>
                                <td>Campus</td>
                                <td>{{$campus->name}}</td>
                            </tr>
                            <tr>
                                <td rowspan="{{count($campus->studies)}}">Studys</td>
                            @foreach($campus->studies as $study)
                            
                                    <td><a href="{{route('study', ['id'=> $study->id])}}" >{{$study->name}}</a></td>
                                    
                                </tr>
                                <tr>
                                @endforeach
                                </tr>
                            <tr>
                                <td>Inactive</td>
                                <td>{{$campus->inactive}}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeCampusToInactive', ['id'=> $campus->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{$campus->inactive? 'Activate' : 'Mark as inactive'}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <div class="panel panel-default">
                <div class="panel-heading">Edit campus</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeCampusName', ['id'=> $campus->id]) }}">
                        {{ csrf_field() }}

                        <div id="nameDiv" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('general.change')
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeCampusAbbreviation', ['id'=> $campus->id]) }}">
                        {{ csrf_field() }}

                        <div id="abbreviationDiv" class="form-group{{ $errors->has('abbreviation') ? ' has-error' : '' }}">
                            <label for="abbreviation" class="col-md-4 control-label">abbreviation</label>

                            <div class="col-md-6">
                                <input id="abbreviation" type="text" class="form-control" name="abbreviation" value="{{ old('abbreviation') }}" autofocus>

                                @if ($errors->has('abbreviation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('abbreviation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('general.change')
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
            
            
            
        </div>
    </div>
</div>
@endsection
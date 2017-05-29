@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> Faculty </h1>
            
            <div class="panel panel-default">
                <div class="panel-heading">Faculty</div>
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
                                <td>City</td>
                                <td>{{$faculty->city}}</td>
                            </tr>
                            <tr>
                                <td>Faculty</td>
                                <td>{{$faculty->name}}</td>
                            </tr>
                            <tr>
                                <td rowspan="{{count($faculty->studies)}}">Studys</td>
                            @foreach($faculty->studies as $study)
                            
                                    <td><a href="{{route('study', ['id'=> $study->id])}}" >{{$study->name}}</a></td>
                                    
                                </tr>
                                <tr>
                                @endforeach
                                </tr>
                            <tr>
                                <td>Inactive</td>
                                <td>{{$faculty->inactive}}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeFacultyToInactive', ['id'=> $faculty->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{$faculty->inactive? 'Activate' : 'Mark as inactive'}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <div class="panel panel-default">
                <div class="panel-heading">Edit faculty</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeFacultyName', ['id'=> $faculty->id]) }}">
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
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeFacultyCity', ['id'=> $faculty->id]) }}">
                        {{ csrf_field() }}

                        <div id="cityDiv" class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">city</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" autofocus>

                                @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
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
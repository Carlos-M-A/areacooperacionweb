@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> Create </h1>
            
            <div class="panel panel-default">
                <div class="panel-heading">Registrar study</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('createStudy') }}">
                        {{ csrf_field() }}

                        <div id="nameDiv" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group{{ $errors->has('branch') ? ' has-error' : '' }}">
                            <label for="branch" class="col-md-4 control-label">branch</label>

                            <div class="col-md-6">
                                <select  id="branch" class="form-control" name="branch" autofocus>
                                    <option value="0">--Choose branch--</option>
                                    <option value="1">Arts and Humanities</option>
                                    <option value="2">Sciences</option>
                                    <option value="3">Health sciences</option>
                                    <option value="4">Social and legal sciences</option>
                                    <option value="5">Engineering and architecture</option>
                                    <option value="6">Other</option>
                                </select>

                                @if ($errors->has('branch'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('branch') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group{{ $errors->has('faculty') ? ' has-error' : '' }}">
                            <label for="faculty" class="col-md-4 control-label">Faculty</label>

                            <div class="col-md-6">
                                <select  id="faculty" class="form-control" name="faculty" autofocus>
                                    <option value="0">--Chose faculty--</option>
                                    
                                    @php
                                        $faculties = App\Faculty::all();
                                    @endphp
                                    @foreach($faculties as $faculty)
                                    <option value="{{$faculty->id}}">{{$faculty->name}} - {{$faculty->city}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('faculty'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('faculty') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
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
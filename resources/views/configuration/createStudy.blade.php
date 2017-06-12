@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> Create </h1>
            
            <div class="panel panel-default">
                <div class="panel-heading">@lang('general.create_study')</div>
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
                        

                        <div class="form-group{{ $errors->has('campus') ? ' has-error' : '' }}">
                            <label for="campus" class="col-md-4 control-label">Campus</label>

                            <div class="col-md-6">
                                <select  id="campus" class="form-control" name="campus" autofocus>
                                    <option value="0">--Chose campus--</option>
                                    
                                    @php
                                        $faculties = App\Campus::all();
                                    @endphp
                                    @foreach($faculties as $campus)
                                    <option value="{{$campus->id}}">{{$campus->name}} - {{$campus->abbreviation}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('campus'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('campus') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('general.create')
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
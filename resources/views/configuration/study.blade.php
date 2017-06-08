@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> Study </h1>
            
            <div class="panel panel-default">
                <div class="panel-heading">@lang('general.studies')</div>
                <div class="panel-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>field</th>
                                <th>Dato</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>City</td>
                                <td>{{$study->faculty->city}}</td>
                            </tr>
                            <tr>
                                <td>Faculty</td>
                                <td><a href="{{route('faculty', ['id'=> $study->faculty->id])}}"> {{$study->faculty->name}} </a></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{$study->name}}</td>
                            </tr>
                            
                            <tr>
                                <td>Branch</td>
                                <td>{{$study->branch}}</td>
                            </tr>
                            <tr>
                                <td>Inactive</td>
                                <td>{{$study->inactive}}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeStudyToInactive', ['id'=> $study->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{$study->inactive? 'Active' : 'Mark as inactive'}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <div class="panel panel-default">
                <div class="panel-heading">Edit studies</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeStudyName', ['id'=> $study->id]) }}">
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
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeStudyBranch', ['id'=> $study->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('branch') ? ' has-error' : '' }}">
                            <label for="branch" class="col-md-4 control-label">branch</label>

                            <div class="col-md-6">
                                <select  id="branch" class="form-control" name="branch" autofocus>
                                    <option value="0">--All branchs--</option>
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
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('general.change')
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('changeStudyFaculty', ['id'=> $study->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('faculty') ? ' has-error' : '' }}">
                            <label for="faculty" class="col-md-4 control-label">Faculty</label>

                            <div class="col-md-6">
                                <select  id="faculty" class="form-control" name="faculty" autofocus>
                                    <option value="0">--Elige una faculty--</option>
                                    
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
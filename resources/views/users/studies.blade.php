@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> Studys </h1>
            
            <button type="button" class="btn btn-primary btn-block" 
                            onclick="event.preventDefault(); document.getElementById('nuevostudy-form').submit();">
                                                     Create study</button>
                    
                    <form id="nuevostudy-form" action="{{ route('showCreateStudy') }}" method="GET" style="display: none;">
                                        </form>
            
            <div class="panel panel-default">
                <div class="panel-heading">Search studies</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('searchStudies') }}">
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
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <div class="panel panel-primary">
                <div class="panel-heading">Studys</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Branch</th>
                            </thead>
                            <tbody>
                                @foreach($studies as $study)
                                <tr>
                                    <td><a href="{{route('study', ['id'=> $study->id])}}" >{{$study->name}}</a></td>
                                    <td>{{$study->branch}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> @lang('general.faculties') </h1>
            
            <button type="button" class="btn btn-primary btn-block" 
                            onclick="event.preventDefault(); document.getElementById('nuevafaculty-form').submit();">
                                                     @lang('general.create_faculty')</button>
                    
                    <form id="nuevafaculty-form" action="{{ route('showCreateFaculty') }}" method="GET" style="display: none;">
                                        </form>
            
            <div class="panel panel-default">
                <div class="panel-heading">@lang('ganeral.search_faculties')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('searchFaculties') }}">
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
                                    @lang('general.search')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <div class="panel panel-primary">
                <div class="panel-heading">Faculties</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>City</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($faculties as $faculty)
                                <tr>
                                    <td><a href="{{route('faculty', ['id'=> $faculty->id])}}" >{{$faculty->name}}</a></td>
                                    <td>{{$faculty->city}}</td>
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
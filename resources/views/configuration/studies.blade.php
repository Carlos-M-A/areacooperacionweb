@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> @lang('general.studies') </h1>
            
            <div class="panel panel-default">
                <div class="panel-heading">Search studies</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ route('searchStudies') }}">

                        <div class="form-group{{ $errors->has('branch') ? ' has-error' : '' }}">
                            <label for="branch" class="col-md-4 control-label">branch</label>

                            <div class="col-md-6">
                                <select  id="branch" class="form-control" name="branch" autofocus>
                                    @if(old('branch')>0)
                                        <option value="{{old('branch')}}">@lang('enums.branch_' . old('branch'))</option>
                                        <option value="0">@lang('enums.branch_0')</option>
                                    @else
                                        <option value="0">@lang('enums.branch_0')</option>
                                    @endif
                                    <option value="1">@lang('enums.branch_1')</option>
                                    <option value="2">@lang('enums.branch_2')</option>
                                    <option value="3">@lang('enums.branch_3')</option>
                                    <option value="4">@lang('enums.branch_4')</option>
                                    <option value="5">@lang('enums.branch_5')</option>
                                    <option value="6">@lang('enums.branch_6')</option>
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
                                    @lang('general.search')
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
                
                <div class="panel-footer">
                    {{ $studies->appends(['branch' => old('branch'), 'name' => old('name')])->links() }}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
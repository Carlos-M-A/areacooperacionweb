@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> @lang('general.campuses') </h1>
            
            <div class="panel panel-default">
                <div class="panel-heading">@lang('general.search_campuses')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ route('searchCampuses') }}">

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
                <div class="panel-heading">Campuses</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Abbreviation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($campuses as $campus)
                                <tr>
                                    <td><a href="{{route('campus', ['id'=> $campus->id])}}" >{{$campus->name}}</a></td>
                                    <td>{{$campus->abbreviation}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="panel-footer">
                    {{ $campuses->appends(['name' => old('name')])->links() }}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
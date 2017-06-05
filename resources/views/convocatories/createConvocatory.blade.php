@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create convocatory</div>
                <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('createConvocatory') }}">
                        {{ csrf_field() }}
                        
                    
                        <div id="title_div" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" autofocus>

                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div id="information_div" class="form-group{{ $errors->has('information') ? ' has-error' : '' }}">
                            <label for="information" class="col-md-4 control-label">information</label>

                            <div class="col-md-6">
                                <textarea id="information" cols="100" rows="7" maxlength="{{config('forms.information')}}"
                                           class="form-control" name="information" autofocus>{{ old('information') }}</textarea>
                                @if ($errors->has('information'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('information') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="estimatedPeriod_div" class="form-group{{ $errors->has('estimatedPeriod') ? ' has-error' : '' }}">
                            <label for="estimatedPeriod" class="col-md-4 control-label">estimatedPeriod</label>

                            <div class="col-md-6">
                                <textarea id="estimatedPeriod" cols="100" rows="7" maxlength="{{config('forms.estimatedPeriod')}}"
                                           class="form-control" name="estimatedPeriod" autofocus>{{ old('estimatedPeriod') }}</textarea>
                                @if ($errors->has('estimatedPeriod'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('estimatedPeriod') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="urlDocumentation_div" class="form-group{{ $errors->has('urlDocumentation') ? ' has-error' : '' }}">
                            <label for="urlDocumentation" class="col-md-4 control-label">urlDocumentation</label>

                            <div class="col-md-6">
                                <input id="urlDocumentation" type="text" class="form-control" name="urlDocumentation" value="{{ old('urlDocumentation') }}" autofocus>

                                @if ($errors->has('urlDocumentation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('urlDocumentation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="deadline_div" class="form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">
                            <label for="deadline" class="col-md-4 control-label">deadline</label>

                            <div class="col-md-6">
                                <input id="deadline" type="date" class="form-control" name="deadline" value="{{ old('deadline') }}" autofocus>

                                @if ($errors->has('deadline'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('deadline') }}</strong>
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

@extends('layouts.app')

@section('more_script')
<link rel="stylesheet" href="{{URL::asset('css/bootstrap-datepicker.min.css')}}" />
    <script src="{{URL::asset('js/bootstrap-datepicker.min.js')}}"></script>
    
<script>
    $( document ).ready(function() {
        $('#deadline').datepicker({
            format: "yyyy-mm-dd",
            weekStart: 1,
            startDate: "tomorrow"
        });
    });
</script>

<script>
    $( document ).ready(function() {
        $('textarea').keyup(function(event) {
            var text_max = $('#' + event.target.id).attr('maxlength');
            var text_length = $('#' + event.target.id).val().length;
            var text_remaining = text_max - text_length;
            
            $('#' + event.target.id).next().html(text_length + ' / ' + text_max);
        });
    });
</script>
@endsection

@section('content')

@php
    $user = Auth::user();
@endphp

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.navigationBar', ['active' => 2])
            <div class="panel panel-info">
                <div class="panel-heading">
                    @lang('general.convocatories')
                    @if($user->role == 5)
                    <ul class="nav nav-pills">
                        <li class=""><a href="{{ route('convocatories') }}">@lang('general.convocatories')</a></li>
                        <li class="active"><a href="{{ route('showCreateConvocatory') }}">@lang('general.create_convocatory')</a></li>
                    </ul>
                    @endif
                </div>
                <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('createConvocatory') }}">
                        {{ csrf_field() }}
                        
                    
                        <div id="title_div" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">@lang('models.title')</label>

                            <div class="col-md-6">
                                <textarea id="title" cols="100" rows="1" maxlength="{{config('forms.convocatory_title')}}"
                                           class="form-control" name="title" autofocus required>{{ old('title') }}</textarea>
                                           <span class="pull-right label label-default"></span>

                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div id="information_div" class="form-group{{ $errors->has('information') ? ' has-error' : '' }}">
                            <label for="information" class="col-md-4 control-label">@lang('models.information')</label>

                            <div class="col-md-6">
                                <textarea id="information" cols="100" rows="7" maxlength="{{config('forms.information')}}"
                                           class="form-control" name="information" autofocus required>{{ old('information') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('information'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('information') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="estimatedPeriod_div" class="form-group{{ $errors->has('estimatedPeriod') ? ' has-error' : '' }}">
                            <label for="estimatedPeriod" class="col-md-4 control-label">@lang('models.estimatedPeriod')</label>

                            <div class="col-md-6">
                                <textarea id="estimatedPeriod" cols="100" rows="2" maxlength="{{config('forms.estimatedPeriod')}}"
                                           class="form-control" name="estimatedPeriod" autofocus required>{{ old('estimatedPeriod') }}</textarea>
                                           <span class="pull-right label label-default"></span>
                                @if ($errors->has('estimatedPeriod'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('estimatedPeriod') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="urlDocumentation_div" class="form-group{{ $errors->has('urlDocumentation') ? ' has-error' : '' }}">
                            <label for="urlDocumentation" class="col-md-4 control-label">@lang('models.estimatedPeriod')</label>

                            <div class="col-md-6">
                                <input id="urlDocumentation" type="url" maxlength="{{config('forms.url')}}"  class="form-control" name="urlDocumentation" value="{{ old('urlDocumentation') }}" autofocus required>

                                @if ($errors->has('urlDocumentation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('urlDocumentation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="deadline_div" class="form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">
                            <label for="deadline" class="col-md-4 control-label">@lang('models.deadline')</label>

                            <div class="col-md-6">
                                <input id="deadline" type="text" class="form-control" name="deadline" value="{{ old('deadline') }}" autofocus required>

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

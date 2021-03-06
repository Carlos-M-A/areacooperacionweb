@extends('layouts.app')

@section('more_script')
@yield('more_more_script')
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
<ul class="pager">
    <li class="previous"><a href="{{route('project', ['id'=> $project->id])}}">@lang('pagination.previous')</a></li>
</ul>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">@lang('general.edit_data')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('editProject', ['id'=> $project->id]) }}">
                        {{ csrf_field() }}

                        <div id="title_div" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">@lang('models.title')</label>

                            <div class="col-md-6">
                                <textarea id="title" cols="100" rows="1" maxlength="{{config('forms.project_title')}}"
                                           class="form-control" name="title" autofocus required>{{ old('title')?old('title') : $project->title }}</textarea>
                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div id="scope_div" class="form-group{{ $errors->has('scope') ? ' has-error' : '' }}">
                            <label for="scope" class="col-md-4 control-label">@lang('models.scope')</label>

                            <div class="col-md-6">
                                <input id="scope" type="text" class="form-control" name="scope" value="{{ old('scope')?old('scope') : $project->scope }}" autofocus required>

                                @if ($errors->has('scope'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('scope') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div id="description_div" class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">@lang('models.description')</label>

                            <div class="col-md-6">
                                <textarea id="description" cols="100" rows="7" maxlength="{{config('forms.project_description')}}"
                                       class="form-control" name="description" 
                                       autofocus required>{{ old('description')?old('description') : $project->description }}</textarea>
                                <span class="pull-right label label-default"></span>
                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div id="urlDocumentation_div" class="form-group{{ $errors->has('urlDocumentation') ? ' has-error' : '' }}">
                            <label for="urlDocumentation" class="col-md-4 control-label">@lang('models.urlDocumentation')</label>

                            <div class="col-md-6">
                                <input id="urlDocumentation" type="url" class="form-control" name="urlDocumentation" value="{{ old('urlDocumentation')?old('urlDocumentation') : $project->urlDocumentation }}" autofocus {{$project->state == 3 ? 'required' : ''}}>

                                @if ($errors->has('urlDocumentation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('urlDocumentation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        @yield('more_fields')
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('general.save')
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
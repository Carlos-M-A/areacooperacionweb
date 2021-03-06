@extends('layouts.app')

@section('more_script')
<script type="text/javascript" src="{{URL::asset("js/bootstrap-filestyle.min.js")}}"> </script>
@endsection

@section('content')

<ul class="pager">
    <li class="previous"><a href="{{ url()->previous() }}">@lang('pagination.previous')</a></li>
</ul>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">@lang('general.edit')</div>
                <div class="panel-body">
                    <div>
                        @lang('explanations.pdf_curriculum_requeriments')
                    </div>
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('uploadCurriculum', ['idUser' => $user->id]) }}">
                        {{ csrf_field() }}

                        <div id="urlCurriculum_div" class="form-group{{ $errors->has('urlCurriculum') ? ' has-error' : '' }}">
                            <label for="urlCurriculum" class="col-md-4 control-label">@lang('urlCurriculum')</label>

                            <div class="col-md-6">
                                <input id="urlCurriculum" type="file" class="form-control filestyle" data-input="true" name="urlCurriculum" value="{{ old('urlCurriculum')}}" >

                                @if ($errors->has('urlCurriculum'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('urlCurriculum') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
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
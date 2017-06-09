@extends('layouts.app')

@section('content')

@section('more_script')
<script type="text/javascript" src="{{url("js/bootstrap-filestyle.min.js")}}"> </script>
@endsection

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">@lang('general.edit')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('uploadAvatar', ['idUser' => $user->id]) }}">
                        {{ csrf_field() }}

                        
                        <div id="urlAvatar_div" class="form-group{{ $errors->has('urlAvatar') ? ' has-error' : '' }}">
                            <label for="urlAvatar" class="col-md-4 control-label">urlAvatar</label>

                            <div class="col-md-6">
                                <input id="urlAvatar" type="file" class="form-control filestyle" data-input="true" name="urlAvatar" value="{{ old('urlAvatar')}}" >

                                @if ($errors->has('urlAvatar'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('urlAvatar') }}</strong>
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
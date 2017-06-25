@php
    $teacher = App\Teacher::find(Auth::user()->id);
    $studies = $teacher->studies;
@endphp

@extends('profile.profile')


@section('studies_teacher')
<div class="panel panel-info">
    <div class="panel-heading">@lang('general.studies_with_teaching')</div>

    <div class="panel-body">
        <ul class="list-group">
            @foreach($teacher->studies as $study)
            
                <li class="list-group-item">
                    <form action="{{route('removeTeachingStudy')}}" method="post">
                        {{ csrf_field() }}
                        {{$study->name}} -- {{$study->campus->name}}   <button type="submit" class="btn btn-danger btn-sm" name="studyWithTeaching" value="{{$study->id}}">
                            @lang('general.delete')
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="panel-footer">
        <div>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('insertTeachingStudy') }}">
                {{ csrf_field() }}
                <div id="studyWithTeachingDiv" name="studyWithTeachingDiv" class="form-group{{ $errors->has('studyWithTeaching') ? ' has-error' : '' }}">


                    <div class="col-md-6">
                        <select  id="studyWithTeaching" class="form-control" name="studyWithTeaching" required>
                            <option value=""></option>
                            @php
                                $studiesList = App\Study::where('inactive', '=', '0')->get();
                            @endphp

                            @foreach($studiesList as $elemento)
                            
                            <option value="{{$elemento->id}}" >
                                {{$elemento->name}} - {{App\Campus::find($elemento->campus_id)->abbreviation}}
                            </option>
                            @endforeach
                        </select>

                        @if ($errors->has('studyWithTeaching'))
                        <span class="help-block">
                            <strong>{{ $errors->first('studyWithTeaching') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            @lang('general.add_study')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
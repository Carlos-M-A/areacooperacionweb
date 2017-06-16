@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> Role change request</h1>
            <div class="panel panel-info">
                <div class="panel-heading">Request data</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>User</td>
                                    <td><a href="{{route('user', ['id'=> $roleChangeRequest->user->id])}}" >{{$roleChangeRequest->user->getNameAndSurnames()}}</a></td>
                                </tr>
                                <tr>
                                    <td>Role current</td>
                                    <td>@lang('enums.role_' . $roleChangeRequest->currentRole)</td>
                                </tr>
                                <tr>
                                    <td>Role new</td>
                                    <td>@lang('enums.role_' . $roleChangeRequest->newRole)</td>
                                </tr>
                                <tr>
                                    <td>areasOfInterest</td>
                                    <td>{{$roleData->areasOfInterest}}</td>
                                </tr>
                                @if($roleChangeRequest->newRole==1)
                                <tr>
                                    <td>skills</td>
                                    <td>{{$roleData->skills}}</td>
                                </tr>
                                @endif
                                @if($roleChangeRequest->newRole==1)
                                <tr>
                                    <td>Curriculum</td>
                                    <td>{{$roleData->urlCurriculum}}</td>
                                </tr>
                                @endif
                                @if($roleChangeRequest->newRole==1)
                                <tr>
                                    <td>Study</td>
                                    <td><a href="{{route('study', ['id'=> $roleData->study->id])}}" >{{$roleData->study->name}}</a></td>
                                </tr>
                                @endif
                                @if($roleChangeRequest->newRole==2)
                                <tr>
                                    <td>departments</td>
                                    <td>{{$roleData->departments}}</td>
                                </tr>
                                @endif
                                @if($roleChangeRequest->newRole==3)
                                <tr>
                                    <td>description</td>
                                    <td>{{$roleData->description}}</td>
                                </tr>
                                @endif
                                @if($roleChangeRequest->newRole==2)
                                <tr>
                                    <td rowspan="{{count($roleData->studies)}}">Studys with teaching</td>
                                    @foreach($roleData->studies as $study)

                                    <td><a href="{{route('study', ['id'=> $study->id])}}" >{{$study->name}}</a></td>

                                    </tr>
                                    <tr>
                                    @endforeach
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <form>
                        {{ csrf_field() }}
                        <div class="btn-group">
                            <button class="btn btn-danger" formmethod="POST" formaction="{{route('rejectRoleChange', ['id'=> $roleChangeRequest->id])}}">@lang('general.reject')</button>
                            <button class="btn btn-success" formmethod="POST" formaction="{{route('acceptRoleChange', ['id'=> $roleChangeRequest->id])}}">@lang('general.accept')</button>
                        </div>
                    </form>

                </div>
            </div>


        </div>
    </div>
</div>
@endsection
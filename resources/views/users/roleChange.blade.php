@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> Role change request</h1>
            <div class="panel panel-primary">
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
                                    <td>{{$roleChangeRequest->currentRole}}</td>
                                </tr>
                                <tr>
                                    <td>Role new</td>
                                    <td>{{$roleChangeRequest->newRole}}</td>
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

                    <form action="{{route('acceptRoleChange', ['id'=> $roleChangeRequest->id])}}" method="post">
                        {{ csrf_field() }}
                        <button class="btn btn-primary" type="submit">@lang('general.Accept')</button>
                    </form>
                    <form action="{{route('rejectRoleChange', ['id'=> $roleChangeRequest->id])}}" method="post">
                        {{ csrf_field() }}
                        <button class="btn btn-primary" type="submit">@lang('general.reject')</button>
                    </form>

                </div>
            </div>


        </div>
    </div>
</div>
@endsection
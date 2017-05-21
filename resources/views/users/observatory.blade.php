@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> The observatory</h1>
            <div class="panel panel-primary">
                <div class="panel-heading">Request to Observatory</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $requests = App\ObservatoryRequest::all();
                                @endphp
                                
                                @foreach($requests as $request)
                                <tr>
                                    <td><a href="{{route('user', ['id'=> $request->user->id])}}" >{{$request->user->getNameAndSurnames()}}</a></td>
                                    <td>{{$request->user->getRoleName()}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-primary">
                <div class="panel-heading">Members</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $members = App\User::where('isObservatoryMember', '=', '1')->get();
                                @endphp
                                
                                @foreach($members as $member)
                                <tr>
                                    <td><a href="{{route('user', ['id'=> $member->id])}}" >{{$member->getNameAndSurnames()}}</a></td>
                                    <td>{{$member->getRoleName()}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

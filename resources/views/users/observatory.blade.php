@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> The observatory</h1>
            <div class="panel panel-default">
                <div class="panel-heading"> 
                    <ul class="nav nav-pills">
                        <li class="{{old('ask')==1 ? 'active' : ''}}"><a href="{{ route('observatory', ['ask' => 1]) }}">Requests<span class="badge">{{App\ObservatoryRequest::all()->count()}}</span></a></li>
                        <li class="{{old('ask')==2 ? 'active' : ''}}"><a href="{{ route('observatory', ['ask' => 2]) }}">Members<span class="badge">{{App\User::where('isObservatoryMember', true)->count()}}</span></a></li>
                    </ul>
                </div>

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
                                @foreach($users as $user)
                                <tr>
                                    <td><a href="{{route('user', ['id'=> $user->id])}}" >{{$user->getNameAndSurnames()}}</a></td>
                                    <td>{{$user->getRoleName()}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    {{ $users->appends(['ask' => old('ask')])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

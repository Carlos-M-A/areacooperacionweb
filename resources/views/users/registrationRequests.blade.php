@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> Registration requests </h1>
            
            
            <div class="panel panel-info">
                <div class="panel-heading">@lang('general.registration_requests')</div>

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
                                    <td>@lang('enums.role_' . $user->role)</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    {{ $users->links() }}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
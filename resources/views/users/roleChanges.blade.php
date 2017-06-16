@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> Role change requests</h1>
            <div class="panel panel-info">
                <div class="panel-heading">@lang('general.role_change_requests')</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>current Role</th>
                                    <th>Role requested</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($requests as $request)
                                <tr>
                                    <td><a href="{{route('roleChange', ['id'=> $request->id])}}" >{{$request->user->getNameAndSurnames()}}</a></td>
                                    <td>@lang('enums.role_' . $request->user->role)</td>
                                    <td>@lang('enums.role_' . $request->newRole)</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    {{ $requests->links() }}
                </div>
            </div>
            
            
        </div>
    </div>
</div>
@endsection

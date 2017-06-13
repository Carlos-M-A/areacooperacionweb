@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1> Users </h1>
            
            
            
            <div class="panel panel-default">
                <div class="panel-heading">@lang('general.search_users')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ route('searchUsers') }}">


                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label">Role of user</label>

                            <div class="col-md-6">
                                <select  id="role" class="form-control" name="role" autofocus>
                                    @if(old('role')>0)
                                        <option value="{{old('role')}}">@lang('enums.role_' . old('role'))</option>
                                        <option value="0">@lang('enums.role_0')</option>
                                    @else
                                        <option value="0">@lang('enums.role_0')</option>
                                    @endif
                                    <option id="roleOption1" value="1">@lang('enums.role_1')</option>
                                    <option id="roleOption2" value="2">@lang('enums.role_2')</option>
                                    <option id="roleOption3" value="3">@lang('enums.role_3')</option>
                                    <option id="roleOption4" value="4">@lang('enums.role_4')</option>
                                    <option id="roleOption5" value="5">@lang('enums.role_5')</option>
                                    <option id="roleOption6" value="6">@lang('enums.role_6')</option>
                                </select>

                                @if ($errors->has('role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div id="nameDiv" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        
                        <div id="idCardDiv" class="form-group{{ $errors->has('idCard') ? ' has-error' : '' }}">
                            <label for="idCard" class="col-md-4 control-label">idCard</label>

                            <div class="col-md-6">
                                <input id="idCard" type="text" class="form-control" name="idCard" value="{{ old('idCard') }}" >

                                @if ($errors->has('idCard'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('idCard') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                   @lang('general.search')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            
            
            
            <div class="panel panel-primary">
                <div class="panel-heading">@lang('general.users')</div>

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
                    {{ $users->appends(['name' => old('name'),'role' => old('role'), 'idCard' => old('idCard')])->links() }}
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
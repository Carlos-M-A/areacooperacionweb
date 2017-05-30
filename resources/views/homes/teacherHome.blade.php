@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Opciones Docente</div>

                <div class="panel-body">
                    <p>
                    <a href="{{ route('myProjects') }}">myProjects</a>
                    <p>
                        <a href="{{ route('showCreateProject') }}">Createproject</a>
                    <p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

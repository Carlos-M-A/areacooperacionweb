@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Offers</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>State</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($convocatories as $convocatory)
                                <tr>
                                    <td><a href="{{route('convocatory', ['id'=> $convocatory->id])}}" >{{$convocatory->title}}</a></td>
                                    <td>{{$convocatory->state}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    {{ $convocatories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

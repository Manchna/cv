@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-body">
                            <h1>Admin</h1>
                        </div>
                        @foreach($users as $user)
                             <a href="{{route('admin_user', ['id' => $user->id])}}" class="list-group-item">Name` {{$user->name}} Email` {{$user->email}}</a></br>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


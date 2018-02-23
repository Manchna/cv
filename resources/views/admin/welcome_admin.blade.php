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
                        <a href="{{route('admin_create_user')}}" class="list-group-item">Create user</a></br>
                        <a href="{{route('admin_users')}}" class="list-group-item">Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


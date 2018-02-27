@extends('layouts.app')
{!! Charts::assets() !!}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-body">
                            <h1 class="text-muted">Admin</h1>
                        </div>
                        <a href="{{route('adminCreateUser')}}" class="list-group-item">Create user</a></br>
                        <a href="{{route('adminUsers')}}" class="list-group-item">Users</a>
                    </div>
                    <div class="col-md-8 col-md-offset-2" style="position: absolute;top: 245px; right: 375px;">
                        {!! $chart->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


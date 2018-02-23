@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-body">
                            <h1>Admin</h1>
                            @include('__forms.admin_user_create_form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


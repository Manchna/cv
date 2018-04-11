@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-body">
                            <h1 class="text-muted">Admin</h1>
                        </div>
                        @include('__forms.adminProfessionCreateForm')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


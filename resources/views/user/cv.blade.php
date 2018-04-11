@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1 class="display-3">Create CV</h1>
                        @include('__forms.userAnswerForm')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

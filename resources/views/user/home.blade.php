@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">

                </div>

                <div class="panel-body">

                    <div class="col-md-8 col-md-offset-10">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Settings</button>

                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">settings</h4>
                                </div>
                                <div class="modal-body">
                                    @include('__forms.user_update_form') </br>
                                    <a href="{{route('user_delete', ['id' => $user->id])}}" class="btn btn-default btn-lg btn-block btn btn-primary">Delete</a></br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

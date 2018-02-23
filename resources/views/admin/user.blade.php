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
                          <h1>Name` {{$user->name}}</h1>
                        <p>Email` {{$user->email}}</p>
                        <div class="col-md-8 " style="position: absolute;left: 100px;">
                            <a href="{{route('admin_user_delete', ['id' => $user->id])}}" class="btn btn-primary ">delete</a>
                        </div>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">update</button>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Update  {{$user->name}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        @include('__forms.admin_user_update_form')
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


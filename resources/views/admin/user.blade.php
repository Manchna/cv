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
                            <h1>Name` {{$data['user']->name}}</h1>
                            <p>Email` {{$data['user']->email}}</p>
                        <div class="col-md-8 " style="position: absolute;left: 371px;">
                            <a href="{{route('adminUserDelete', ['id' => $data['user']->id])}}" class="btn btn-primary ">delete user</a>
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">update user</button>
                        @if(count($data['answers'] ) > 0 )

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateUserCV">update user cv</button>
                                <a href="{{route('pdfView', ['id' => $data['user']->id, 'download'=>1])}}" class="btn btn-primary " >Download pdf</a>

                            <div class="embed-responsive embed-responsive-16by9" style="height: 1045px;">
                                <embed  class="embed-responsive-item" src="{{ route('pdfView',['id' => $data['user']->id, 'download'=>0]) }}" width="500" height="1000" type='application/pdf'>
                            </div>
                                <!-- Modal -->
                                <div class="modal fade" id="updateUserCV" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Update  {{$data['user']->name}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                @include('__forms.AdminUserAnswersUpdateForm')
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Update  {{$data['user']->name}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        @include('__forms.adminUserUpdateForm')
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


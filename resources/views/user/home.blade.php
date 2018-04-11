    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-10" style="position: absolute; left: 0px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">My Settings</button></br>

        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if (  count($data['answers'] ) <= 0)
                            <h1 class="display-3">Create CV</h1>
                            @include('__forms.userProfessionForm')
                        @endif

                    @if(count($data['answers'] ) > 0 )

                        <!-- Trigger the modal with a button -->
                        <div >
                            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#updateCv">Update CV</button>
                            <a href="{{route('pdfView', ['id' => $data['user']->id, 'download'=>1])}}" class="btn btn-primary " >Download pdf</a>
                        </div>

                            <div class="embed-responsive embed-responsive-16by9" style="height: 1045px;">
                                <embed  class="embed-responsive-item" src="{{ route('pdfView',['id' => $data['user']->id, 'download'=>0]) }}" width="500" height="1000" type='application/pdf'>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="updateCv" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Modal Header</h4>
                                        </div>
                                        <div class="modal-body">
                                          @include('__forms.userUpdateAnswersForm')
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif
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
                                        @include('__forms.userUpdateForm') </br>
                                        <a href="{{route('userDelete', ['id' => $data['user']->id])}}" class="btn btn-default btn-lg btn-block btn btn-primary">Delete</a></br>
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

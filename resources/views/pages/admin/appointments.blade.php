@extends('layouts.admin-layout')

@section('content')


                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3><i class="far fa-clipboard"></i></i> Appointments List</h3>
                            </div>

                            <div class="card-body">

                                <table class="table table-responsive-xl table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Note</th>
                                        <th scope="col">Approve</th>
                                        <th scope="col">Decline</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($apps as $app)
                                        <tr>
                                            <th scope="row">{{$app->date}}</th>
                                            <td>{{$app->time}}</td>
                                            <td>{{$app->note}}</td>
                                            <td><a href="approve/{{$app->idApp}}" class="btn btn-success approveApp" data-id="${app.idApp}">Approve</a></td>
                                            <td><a href="decline/{{$app->idApp}}" class="btn btn-danger declineApp" data-id="${app.idApp}">Decline</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!-- end card-->
                    </div>
                </div>
                <!-- end row -->

@endsection

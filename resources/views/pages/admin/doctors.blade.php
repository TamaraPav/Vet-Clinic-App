@extends('layouts.admin-layout')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fas fa-user-md"></i> All Doctors</h3>
                    Here you can see list of all doctors.
                </div>

                <div class="card-body">

                    <table class="table table-responsive-xl table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Licence</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($docs as $doc)
                            <tr>
                                <th scope="row">{{$doc->idVet}}</th>
                                <td>{{$doc->licence}}</td>
                                <td>{{$doc->firstName}}</td>
                                <td>{{$doc->lastName}}</td>
                                <td>{{$doc->email}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
            <!-- end card-->
        </div>
    </div>

@endsection

@extends('layouts.admin-layout')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fas fa-pills"></i> All Medications</h3>
                    Here you can see list of all medications.
                </div>

                <div class="card-body">

                    <table class="table table-responsive-xl table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($meds as $med)
                            <tr>
                                <th scope="row">{{$med->idMedication}}</th>
                                <td>{{$med->name}}</td>
                                <td><a href="#" class="btn btn-danger deleteMed" data-id="{{$med->idMedication}}">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
            <!-- end card-->
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fas fa-pills"></i></i> Add new Medication</h3>
                    Here you can add a new medication.
                </div>

                <div class="card-body">

                    <div>
                        <form action="{{route('admin.addNewMed')}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <table class="table">
                                <tr>
                                    <td>Name</td>
                                    <td><input type="text" name="name" id="name"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><button class="btn btn-success" type="sumbit" name="addMed" id="addMed" value="Add">Add</button></td>
                                </tr>

                            </table>
                        </form>
                    </div>
                    @if($errors->any())
                        {{ implode('', $errors->all(':message')) }}
                    @endif
                    @if(session()->has('message'))
                        {{ session('message') }}
                    @endif
                </div>
            </div>
            <!-- end card-->
        </div>
    </div>

@endsection

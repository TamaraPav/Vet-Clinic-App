@extends('layouts.admin-layout')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fas fa-briefcase-medical"></i></i> All Diagnosis</h3>
                    Here you can see list of all diagnosis.
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
                        @foreach($dgs as $dg)
                            <tr>
                                <th scope="row">{{$dg->idDiagnosis}}</th>
                                <td>{{$dg->name}}</td>
                                <td><a href="#" class="btn btn-danger deleteDiagnose" data-id="{{$dg->idDiagnosis}}">Delete</a></td>
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
                    <h3><i class="fas fa-briefcase-medical"></i></i> Add new Diagnose</h3>
                    Here you can add a new diagnose.
                </div>

                <div class="card-body">

                    <div>
                        <form action="{{route('admin.addNewDg')}}" method="POST" onsubmit="return checkReg()" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <table class="table">
                                <tr>
                                    <td>Name</td>
                                    <td><input type="text" name="name" id="name"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><button class="btn btn-success" type="sumbit" name="addDg" id="addDg" value="Add">Add</button></td>
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

@extends('layouts.admin-layout')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fas fa-cat"></i></i> All Pets</h3>
                    Here you can see list of all pets.
                </div>

                <div class="card-body">
<input type="search" id="search"/>
                    <table class="table table-responsive-xl table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Blood Type</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Allergies</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody id="searchPet">
                        @foreach($pets as $pet)
                            <tr>
                                <th scope="row">{{$pet->idPet}}</th>
                                <td>{{$pet->firstName}} {{$pet->lastName}}</td>
                                <td>{{$pet->name}}</td>
                                <td>{{$pet->gender}}</td>
                                <td>{{$pet->bloodType}}</td>
                                <td>{{$pet->dateOfBirth}}</td>
                                <td>{{$pet->allergies}}</td>
                                <td ><a class="btn btn-success" href="{{ route('editPet', $pet->idPet)}}">Edit</a></td>
                                <td><a href="#" class="btn btn-danger deletePet" data-id="{{$pet->idPet}}">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
            <!-- end card-->
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fas fa-cat"></i></i> Add new Pet</h3>
                    Here you can add a new pet.
                </div>

                <div class="card-body">

                    <div>
                        @include('pages.users.formAdd', ['action' => 'addPet'])
                    </div>
                    @if(session()->has('message'))
                        {{ session('message') }}
                    @endif
                </div>
            </div>
            <!-- end card-->
        </div>
    </div>

@endsection

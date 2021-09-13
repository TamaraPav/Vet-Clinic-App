
@extends('layouts.layout')

@section('title') {{ session()->get('user')->firstName }} {{ session()->get('user')->lastName }}@endsection
@section('description') The main doctor page. @endsection
@section('keywords') clinic, vet, pet, doctor @endsection

@section('content')
    <section class="main-content" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div>
                        <h1>Hello {{ session()->get('user')->firstName }}</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
@if(session('user')->idRole == '3')
                        @foreach($pets as $pet)

                                <div class="col-md-12 col-sm-12 app-card">
                                    <div class="col-md-3 col-sm-12">
                                        <p><img class="pet" src="{{ asset('assets/images/pets/' . $pet->image) }}" alt="{{ $pet->alt }}"/></p>
                                    </div>

                                    <div class="col-md-9 col-sm-12">
                                        <table class="table">
                                            <tr>
                                                <td><h2>{{$pet->name}}</h2></td>
                                                <td><a class="btn btn-edit" href="{{ route('pet', $pet->idPet )}}">Show Chart</a></td>
                                                <td><a href="#" class="btn btn-danger deletePet" data-id="{{$pet->idPet}}">Delete</a></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                        @endforeach
                            <a class="btn btn-edit" href="{{ route('addPets')}}">Add another pet</a>
@endif
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <h2>{{$user->firstName}} {{$user->lastName}}</h2>
                            <p>{{$user->email}}</p>
                            <p>{{$user->phone}}</p>
                            <p>{{$user->address}}</p>
                            <a class="btn btn-edit" href="{{ route('editUserU', $user->idUser)}}">Edit Your Info</a><br><br>
                            @if(session()->has('message'))
                                {{ session('message') }}
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection

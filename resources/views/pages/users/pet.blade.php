
@extends('layouts.layout')

@section('title') Pet Chart @endsection
@section('description') The pet chart page. @endsection
@section('keywords') chart, pet @endsection

@section('content')
    <section class="main-content" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="row">
                        <h2>Pet Info</h2>
                        @foreach($onePet as $pet)
                            <div class="col-md-12 col-sm-12 app-card">
                                <div class="col-md-3 col-sm-12">
                                    <p><img class="pet" src="{{ asset('assets/images/pets/' . $pet->image) }}" alt="{{ $pet->alt }}"/></p>
                                </div>

                                <div class="col-md-9 col-sm-12">
                                    <table class="table">
                                        <tr>
                                            <td>Name: {{$pet->name}}</td>
                                            <td>Sex: {{$pet->gender}}</td>
                                        </tr>
                                        <tr>
                                            <td>Blood type: {{$pet->bloodType}}</td>
                                            <td>Date of Birth: {{$pet->dateOfBirth}}</td>
                                        </tr>
                                        <tr>
                                            <td>Alergies: @if($pet->allergies == '')None @endif {{$pet->allergies}}</td>
                                            <td >@if(session('user')->idRole == 3)<a class="btn btn-edit" href="{{ route('editPet', $pet->idPet)}}">Edit Pet Info</a>@endif</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <h2>Past Visits</h2>
                        @forelse($visits as $visit)
                            <div class="col-md-12 col-sm-12 app-card">
                                <p>Date and time: {{$visit->date}} {{$visit->time}}</p>
                                <p>Diagnosis: {{$visit->diagnose}}</p>
                                <p>Medication: {{$visit->meds}}, {{$visit->quantity}}</p>
                                <p>Summary: {{$visit->summary}}</p>
                                <p>Doctor: {{$visit->firstName}}</p>

                            </div>
                        @empty
                            <h4>No past visits.</h4>
                        @endforelse
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h2>Scheduled Appointments</h2>
                    @forelse($appointments as $app)
                        <div class="col-md-12 col-sm-12 app-card">
                            <p>Date and time: {{$app->date}} {{$app->time}}</p>
                            <p>Note: {{$app->note}}</p>
                            <form action="{{route('app.destroy', $app->idApp)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Cancel</button>
                                @if(session()->get('user')->idRole == 2)
                                    <a class="btn btn-edit" href="{{ route('addVisit', [$app->idApp, $pet->idPet])}}">Add new Visit</a>
                                @endif
                            </form>
                        </div>

                    @empty
                        <h4>No appointments.</h4>
                    @endforelse
                    <a class="btn btn-edit" href="{{ route('addApps', $pet->idPet)}}">Schedule new appointment</a>
                    @if(session()->has('message'))
                        {{ session('message') }}
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

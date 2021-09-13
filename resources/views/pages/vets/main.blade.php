
@extends('layouts.layout')

@section('title') Doctor @endsection
@section('description') The main doctor page. @endsection
@section('keywords') clinic, vet, pet, doctor @endsection

@section('content')
    <section class="main-content" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row" id="doctor">
                <div class="col-md-12 col-sm-12">
                    <div>
                        <h1>Hello Doctor <a href="{{url('/user')}}">{{ session()->get('user')->firstName }}</a></h1>
                    </div>
                    <div class="row">
                            <h4>Your appointments for today:
                            </h4>
                        <select id="filterApp">
                            <option value="0">Not Completed</option>
                            <option value="1">Completed</option>
                        </select>
                    </div>
                    <div class="row">
                        <div id="showApps" class="col-md-8 col-sm-12">

                        </div>
                        <div class="col-md-4 col-sm-12">
                            <h3>Add new Appointment</h3>
                            <form action="{{route('doctor.addAppointment')}}" method="POST"  enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <input type="hidden" name="approve" value="1"/>
                                <select class="form-control" id="pet" name="pet">
                                    <option value="0" >Choose Pet</option>
                                    @foreach($pets as $pet)
                                        <option value="{{$pet->idPet}}">{{$pet->name}}</option>
                                    @endforeach
                                </select>
                                <input type="date" class="form-control" name="date" id="date" required/>
                                <input type="text" class="form-control" placeholder='Time' name="time" id="time" required>
                                <input type="text" class="form-control" name="note" placeholder="Note" id="note">
                                <input type="hidden" name="completed" value="0"/>

                                <button type="submit" class="form-control btn-success" name="addPet" id="addPet" >Add Appointment</button>
                                @if(session()->has('message'))
                                    {{ session('message') }}
                                @endif


                            </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection

@extends('layouts.admin-layout')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fas fa-user-friends"></i></i> Update User</h3>
                    Here you can update user info.
                </div>

                <div class="card-body">

                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                        <input type="text" class="form-control" name="firstName" id="firstName" value="{{ $korisnik->firstName ?? old('firstName') }}" required>
                        <input type="text" class="form-control" name="lastName" id="lastName" value="{{ $korisnik->lastName ?? old('lastName') }}" required>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $korisnik->email ?? old('email') }}"required>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ $korisnik->phone ?? old('phone') }}"required>
                        <input type="text" class="form-control" name="address" value="{{ $korisnik->address ?? old('address') }}" id="address">
                        <input type="text" class="form-control" name="role" value="{{ $korisnik->idRole ?? old('idRole') }}" id="role">
                        <a href="#" class="form-control btn-success" name="updateUser" id="updateUser" data-id="{{ $korisnik->idUser }}">Update</a>
                    <div class="err-message"></div>


                </div>
            </div>
            <!-- end card-->
        </div>

    </div>

@endsection

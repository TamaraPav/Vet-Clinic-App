@extends('layouts.layout')

@section('title') Home @endsection
@section('description') The main page of the clinic. @endsection
@section('keywords') clinic, vet, pet, login, register @endsection

@section('content')
    <section class="main-content" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-12">
                    <div>
                        <h1>True Friend Clinic</h1>
                    </div>
                    <!-- NAV TABS -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#sign_in" aria-controls="sign_in" role="tab" data-toggle="tab">Sign In</a></li>
                        <li><a href="#sign_up" aria-controls="sign_up" role="tab" data-toggle="tab">Create an account</a></li>
                    </ul>

                    <!-- TAB PANES -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in" id="sign_up">
                            <form action="{{ url('/register') }}" method="POST" onsubmit="return checkReg()">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <input type="text" class="form-control" name="firstName" placeholder="Name" id="tbFirstName" required>
                                <input type="text" class="form-control" name="lastName" placeholder="Last Name" id="tbLastName" required>
                                <input type="text" class="form-control" name="telephone" placeholder="Telephone" id="tbPhone" required>
                                <input type="text" class="form-control" name="address" placeholder="Address" id="tbAddress" required>
                                <input type="email" class="form-control" name="email" placeholder="Email" id="tbEmailReg" required>
                                <input type="password" class="form-control" name="password" placeholder="Password" id="tbPassReg" required>
                                <input type="password" class="form-control" name="repPass" placeholder="Password" id="tbPassAgain" required>
                                <button type="submit" class="form-control" name="reg" id="register">Register</button>

                            </form>
                        </div>

                        <div role="tabpanel" class="tab-pane fade in active" id="sign_in">
                            <form action="{{ url('/login') }}" method="POST" onsubmit="return checkLog()">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <input type="email" class="form-control" name="emailLog" placeholder="Email" id="tbEmail" required>
                                <input type="password" class="form-control" name="passwordLog" placeholder="Password" id="tbPass"  required>
                                <button type="submit" class="form-control" name="login" id="login">Login</button>
                            </form>
                        </div>

                        <div class="row" id="err">
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

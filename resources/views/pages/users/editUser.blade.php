@extends('layouts.layout')

@section('title') Add Pet @endsection
@section('description') The add pet page. @endsection
@section('keywords') add, pet @endsection

@section('content')
    <section class="main-content" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <h2>Edit Your Info</h2>
                            @include('pages.users.formEditUser', ['action' => 'updateUser']);
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection

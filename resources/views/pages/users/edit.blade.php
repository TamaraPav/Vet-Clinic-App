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
                            <h2>Edit Pet Info</h2>
                            @include('pages.users.formAdd', ['action' => 'updatePet']);
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection

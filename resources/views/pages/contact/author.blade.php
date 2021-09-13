@extends('layouts.layout')

@section('title') Contact @endsection
@section('description') Learn more about us or contact us. @endsection
@section('keywords') vet, clinic, contact @endsection

@section('content')
    <section id="contact" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-12">
                    <div class="section-title">
                        <h1>Welcome to Author section</h1>
                        <span class="line-bar">...</span>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="col-md-4 col-sm-12">
                        <img class="authorImage" src="{{ asset('assets/images/' . 'author.jpg') }}" alt="author"/>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <p class="authorText">My name is Tamara Pavlović, I live in Mladenovac, Serbia. Currently I am a student at The ICT College of Applied Studies - Internet Technologies. When I was a little girl I wanted to be many things when I grow up, but when I saw the beauty and creativity of Web Design, I instantly fell in love with it.</p>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- /.container -->
@endsection

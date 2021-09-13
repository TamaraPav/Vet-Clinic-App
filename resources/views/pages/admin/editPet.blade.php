@extends('layouts.admin-layout')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fas fa-cat"></i></i> Update Pet</h3>
                    Here you can update pet info.
                </div>

                <div class="card-body">

                    @include('pages.users.formAdd', ['action' => 'updatePet']);

                </div>
            </div>
            <!-- end card-->
        </div>
    </div>

@endsection

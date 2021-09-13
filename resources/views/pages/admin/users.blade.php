@extends('layouts.admin-layout')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fas fa-user-friends"></i> All Users</h3>
                    Here you can see list of all users.
                </div>

                <div class="card-body">

                    <table class="table table-responsive-xl table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Role</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->idUser}}</th>
                            <td>{{$user->firstName}}</td>
                            <td>{{$user->lastName}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->idRole}}</td>
                            <td><a href="{{url('admin/updateUser/')}}/{{$user->idUser}}" class="btn btn-success" data-id="{{$user->idUser}}">Edit</a></td>
                            <td><a href="{{url('admin/deleteUser/')}}/{{$user->idUser}}" class="btn btn-danger" data-id="{{$user->idUser}}">Delete</a></td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
            <!-- end card-->
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="fas fa-user-friends"></i> Add new user</h3>
                    Here you can add a new user.
                </div>

                <div class="card-body">

                    <div>
                        <form action="{{route('addNewUser')}}" method="POST" onsubmit="return checkReg()" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <table class="table">
                                <tr>
                                    <td>First Name</td>
                                    <td><input type="text" name="fName" id="fName"></td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td><input type="text" name="lName" id="lName"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" name="email" id="email"></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td><input type="password" name="password" id="password"></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><input type="text" name="phone" id="phone"></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><input type="text" name="address" id="address"></td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td><input type="text" name="role" id="role" placeholder="1-Admin, 2-Vet, 3-User"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><button class="btn btn-success" type="sumbit" name="addUser" id="addUser" value="Add">Add</button></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    @if($errors->any())
                        {{ implode('', $errors->all(':message')) }}
                    @endif
                    @if(session()->has('message'))
                        {{ session('message') }}
                    @endif
                </div>
            </div>
            <!-- end card-->
        </div>
    </div>

@endsection

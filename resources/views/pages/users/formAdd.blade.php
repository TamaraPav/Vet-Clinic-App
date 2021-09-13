<form action="@if($action == 'updatePet') {{route($action, $pet->idPet)}} @else {{route($action)}} @endif" method="POST"  enctype="multipart/form-data">
    @csrf
    @if($action == "updatePet")

        @method('PUT')

    @endif
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    @if($action == 'updatePet')
        <input type="hidden" name="id" value="{{$pet->idPet}}"/>
        <input type="hidden" name="idImage" value="{{$pet->image}}"/>
    @endif

    @if(session('user')->idRole == 1)
            <select class="form-control" id="owner" name="owner">
                    <option value="{{ $pet->idOwner ?? old('owner') }}" >Choose Owner</option>
                    @foreach($users as $user)
                        <option value="{{$user->idUser}}">{{$user->firstName}} {{$user->lastName}}</option>
                    @endforeach
                </select>
    @endif
    <input type="text" class="form-control" name="petName" placeholder="Name" value="@if($action == 'updatePet'){{ $pet->name ?? old('name') }}@endif" id="PetName" required>
    @if($action == 'addPet')
        <div class="form-check form-check-inline">
            <input type="radio" class="form-check" name="gender" value="M" id="male">M
            <input type="radio" class="form-check" name="gender" value="F" id="female">F
        </div>
        <div>
            @foreach($types as $type)
                <input type="radio" id="type{{ $type->idType }}" name="type" value="{{ $type->idType }}"/> {{$type->name}}
            @endforeach
        </div>
    @endif
    <input type="file" class="form-control" name="image" id="image">
    <input type="text" class="form-control" name="bloodType" placeholder="Blood Type" value="@if($action == 'updatePet'){{ $pet->bloodType ?? old('bloodType') }}@endif" id="bloodType" required>
    <input type="date" class="form-control" name="dob" value="@if($action == 'updatePet'){{ $pet->dateOfBirth ?? old('dateOfBirth') }}@endif" id="dob" required>
    <input type="text" class="form-control" name="allergies" placeholder="Allergies" value="@if($action == 'updatePet'){{ $pet->allergies ?? old('allergies') }}@endif" id="allergies">
    <button type="submit" class="form-control btn-success" name="addPet" id="addPet" >@if($action == 'updatePet') Update Pet @else Add Pet @endif </button>
    @if($errors->any())
        {{ implode('', $errors->all(':message')) }}
    @endif


</form>

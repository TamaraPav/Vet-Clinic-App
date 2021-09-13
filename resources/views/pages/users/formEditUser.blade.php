<form action="{{route($action)}}" method="POST"  enctype="multipart/form-data">
    @csrf
    @if($action == "updateUser")

        @method('PUT')

    @endif
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>

    <input type="text" class="form-control" name="firstName" id="firstName" value="{{ $korisnik->firstName ?? old('firstName') }}" required>
    <input type="text" class="form-control" name="lastName" id="lastName" value="{{ $korisnik->lastName ?? old('lastName') }}" required>
    <input type="email" class="form-control" name="email" id="email" value="{{ $korisnik->email ?? old('email') }}"required>
    <input type="text" class="form-control" name="phone" id="phone" value="{{ $korisnik->phone ?? old('phone') }}"required>
    <input type="text" class="form-control" name="address" value="{{ $korisnik->address ?? old('address') }}" id="address">
    <button type="submit" class="form-control" name="updateUser" id="updateUser">Update</button>
    @if($errors->any())
        {{ implode('', $errors->all(':message')) }}
    @endif
</form>

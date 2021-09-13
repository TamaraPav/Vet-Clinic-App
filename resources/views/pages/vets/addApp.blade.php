<form action="{{route('addApp')}}" method="POST"  enctype="multipart/form-data">
    @if($approve == 'yes')
        <input type="hidden" name="approve" value="0"/>
    @else
        <input type="hidden" name="approve" value="1"/>
    @endif
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>

        <label>Choose Doctor: </label>
        @foreach($docs as $doc)
            <input type="radio" id="type{{ $doc->idVet }}" name="vet" value="{{ $doc->idVet }}"/> {{$doc->firstName}}
        @endforeach
    <input type="date" class="form-control" name="date" id="date" required/>
    <input type="text" class="form-control" placeholder='Time' name="time" id="time" required>
    <input type="text" class="form-control" name="note" placeholder="Note" id="note">
    <input type="hidden" name="completed" value="0"/>
    <input type="hidden" name="pet" value="{{$pet->idPet}}"/>
    <button type="submit" class="form-control" name="addPet" id="addPet" >Add Appointment</button>
        @if($errors->any())
            {{ implode('', $errors->all(':message')) }}
        @endif
        @if(session()->has('message'))
            {{ session('message') }}
        @endif
</form>

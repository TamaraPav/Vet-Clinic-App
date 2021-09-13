<form action="{{route('addV')}}" method="POST"  enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>

    <label>Choose Diagnosis: </label>
        <select name="diagnose" id="diagnose">
            @foreach($dg as $d)
                <option value="{{$d->idDiagnosis}}">{{$d->name}}</option>
            @endforeach
        </select>
    <label>Choose Medication: </label>
        <select name="medication" id="medication">
            @foreach($meds as $med)
                <option value="{{$med->idMedication}}">{{$med->name}}</option>
            @endforeach
        </select>

        <input type="text" class="form-control" placeholder="qty" name="qty" id="qty" required/>
        <textarea class="form-control" placeholder="summary" name="summ" id="summ" rows="4" required></textarea>
        <input type="hidden" name="app" value="{{$appointment->idApp}}"/>

    <button type="submit" class="form-control" name="addPet" id="addPet" >Add Visit</button>
    @if($errors->any())
        {{ implode('', $errors->all(':message')) }}
    @endif
    @if(session()->has('message'))
        {{ session('message') }}
    @endif
</form>

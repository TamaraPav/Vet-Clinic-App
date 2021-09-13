<?php

namespace App\Http\Controllers;


use App\Models\Korisnik;
use App\Models\Pet;

class DoctorController extends OsnovniController
{
    public function index(){
        $modelP = new Pet();
        $result1 = $modelP->getAllPets();
        $this->data["pets"] = $result1;

        return view('pages.vets.main', $this->data);
    }

    public function showDoctors(){
        $modelDoc = new Korisnik();
        $result = $modelDoc->allDocs();
        $this->data['docs'] = $result;
        return view('pages.admin.doctors', $this->data);
    }
}

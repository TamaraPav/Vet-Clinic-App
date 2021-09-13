<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Visit extends Model
{
    public function getVisits(){
        return DB::table('medications')
            ->join('visits', 'medications.idMedication', '=', 'visits.idMedication')
            ->get();
    }

    public function getVisitsOfPet($pet){
        return DB::table('visits')
            ->join('diagnosis', 'visits.idDiagnosis', '=', 'diagnosis.idDiagnosis')
            ->join('medications','visits.idMedication','=','medications.idMedication')
            ->join('appointments','visits.idApp','=','appointments.idApp')
            ->join('vets','appointments.idVet','=','vets.idVet')
            ->join('users','vets.idUser', '=', 'users.idUser')
            ->select('appointments.date','appointments.time', 'diagnosis.name as diagnose', 'medications.name as meds', 'visits.quantity','visits.summary', 'users.firstName')
            ->where('appointments.idPet', '=', $pet)
            ->get();
    }

    public function insertVisit($dg,$med,$qty,$idApp,$summ){
        return DB::table('visits')->insertGetId(["idDiagnosis"=>$dg,"idMedication"=>$med,"quantity"=>$qty,"idApp"=>$idApp,"summary"=>$summ]);
    }
}

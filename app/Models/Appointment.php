<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    use HasFactory;

    public function getAppointments($id, $date, $done){
        //dd($id, $date, $done);
        return DB::table('appointments')
            ->join('pets', 'appointments.idPet', '=', 'pets.idPet')
            ->join('vets', 'appointments.idVet', '=', 'vets.idVet')
            ->join('users', 'pets.idOwner', '=', 'users.idUser')
            ->join('pettypes', 'pets.idType', '=', 'pettypes.idType')
            ->select('users.firstName', 'users.lastName','pets.name as pet', 'pettypes.name as type', 'appointments.date', 'appointments.time', 'appointments.idPet')
            ->where([
                ["vets.idUser", "=", $id],
                ['appointments.completed','=',$done],
                ['appointments.approved','=','1'],
                ['appointments.date','=',$date]
            ])
            ->get();
    }

    public function getAppointmentsMonth($id, $date){
        return DB::table('appointments')
            ->join('pets', 'appointments.idPet', '=', 'pets.idPet')
            ->join('vets', 'appointments.idVet', '=', 'vets.idVet')
            ->join('users', 'pets.idOwner', '=', 'users.idUser')
            ->join('pettypes', 'pets.idType', '=', 'pettypes.idType')
            ->select('users.firstName', 'users.lastName','pets.name as pet', 'pettypes.name as type', 'appointments.date', 'appointments.time', 'appointments.idPet')
            ->where([
                ["vets.idUser", "=", $id],
                ['appointments.completed','=','0'],
                ['appointments.approved','=','1']
                //['appointments.date','=',$date]
            ])
            ->whereMonth('appointments.date','=',$date)
            ->get();
    }

    public function getAllDocs(){
        return DB::table('vets')
            ->join('users','vets.idUser', '=', 'users.idUser')
            ->get();
    }
    public function insertAppointment($idPet,$idVet,$date,$time,$note,$approve,$completed){
        return DB::table('appointments')->insertGetId(["idPet"=>$idPet,"idVet"=>$idVet,"date"=>$date,"time"=>$time,"note"=>$note,"approved"=>$approve,"completed"=>$completed]);
    }

    public function checkIfAvailable($date, $time){
        return DB::table('appointments')
            ->where([
                ["date", "=", $date],
                ['time','=',$time]
            ])
            ->get();
    }

    public function getAppointmentsOfPet($pet){
        return DB::table('appointments')
            ->join('pets', 'appointments.idPet', '=', 'pets.idPet')
            ->join('vets', 'appointments.idVet', '=', 'vets.idVet')
            ->join('users', 'vets.idVet', '=', 'users.idUser')
            ->where([
                ["pets.idPet", "=", $pet],
                ['appointments.completed', '0'],
                ['appointments.approved', '1']
            ])
            ->get();
    }
    public function getAppForVisit($idApp){
        return DB::table('appointments')
            ->where("idApp", "=", $idApp)
            ->first();

    }

    public function updateApp($idApp){
        //dd($idApp);
        return DB::table('appointments')
            ->where("idApp","=", $idApp)
            ->update(["approved"=>'1']);

    }
    public function updateAppo($idApp){
        //dd($idApp);
        return DB::table('appointments')
            ->where("idApp","=", $idApp)
            ->update(["completed"=>'1']);

    }
    public function getAppForApprovement(){
        return DB::table('appointments')
            ->where("approved", "=", '0')
            ->get();
    }
    public function deleteApp($id){
        return  DB::table('appointments')->where("idApp","=",$id)->delete();
    }
}

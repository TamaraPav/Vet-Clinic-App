<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pet extends Model
{

    public function getPets($id){
        return DB::table('pets')
            ->join('users', 'pets.idOwner', '=', 'users.idUser')
            ->join('images', 'pets.idImage', '=', 'images.idImage')
            ->where('idOwner', '=', $id)
            ->get();
    }
    public function getAllPets(){
        return DB::table('pets')
            ->join('users', 'pets.idOwner', '=', 'users.idUser')
            ->join('images', 'pets.idImage', '=', 'images.idImage')
            ->get();
    }

    public function getPet($id){
        return DB::table('pets')
            ->join('users', 'pets.idOwner', '=', 'users.idUser')
            ->join('images', 'pets.idImage', '=', 'images.idImage')
            ->where('idPet', '=', $id)
            ->get();
    }
    public function petForEdit($id){
        //dd($id);
        return DB::table('pets')
            ->join('users', 'pets.idOwner', '=', 'users.idUser')
            ->join('images', 'pets.idImage', '=', 'images.idImage')
            ->where('idPet', '=', $id)
            ->first();
    }

    public function getPetForVisit($idPet){
        return DB::table('pets')
            ->where('idPet', '=', $idPet)
            ->first();
    }

    public function getAllTypes(){
        return DB::table('pettypes')->get();
    }

    public function insertPet($idOwner,$idType,$idImage,$name,$gender,$bloodType,$dob,$allergies){

        return DB::table('pets')->insertGetId(['idOwner'=>$idOwner,'idType'=>$idType,'idImage'=>$idImage, 'name'=>$name,'gender'=>$gender,'bloodType'=>$bloodType, 'dateOfBirth'=>$dob,'allergies'=>$allergies]);
    }

    public function updatePett($id, $idOwner, $image, $name, $bloodType, $dob, $allergies){
        return DB::table('pets')
            ->where("idPet","=",$id)
            ->update(["idOwner"=>$idOwner, "idImage"=>$image,"name"=>$name,"bloodType"=>$bloodType, "dateOfBirth"=>$dob,"allergies"=>$allergies]);
    }

    public function storeType($name){
        return DB::table('pettypes')->insertGetId(['name'=>$name]);
    }

    public function searchPet($search){
        return DB::table('pets')
            ->join('users', 'pets.idOwner', '=', 'users.idUser')
            ->join('images', 'pets.idImage', '=', 'images.idImage')
            ->where('pets.name', 'LIKE', "{$search}%")
            ->get();
    }
}

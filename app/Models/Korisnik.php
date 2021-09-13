<?php


namespace App\Models;

use Illuminate\Support\Facades\DB;

class Korisnik
{
    public function getUser($email,$password){
        return DB::table("users")
            ->select("idUser","firstName","lastName","email","idRole")
            ->where([
                ["email", "=", $email],
                ["password", "=", $password]
            ])
            ->first();
    }

    public function insertUser($name,$lastName,$email,$password,$phone,$address,$role){
        return DB::table('users')->insertGetId(["firstName"=>$name,"lastName"=>$lastName,"email"=>$email,"password"=>$password,"phone"=>$phone,"address"=>$address,"idRole"=>$role]);
    }

    public function getUserWithId($id){
        return DB::table("users")
            ->select("idUser","firstName","lastName","email","phone","address", "idRole")
            ->where([
                ["idUser", "=", $id]
            ])
            ->first();
    }

    public function getAllUser(){
        return DB::table("users")
            ->where([
                ["idRole", "=", '3']
            ])
            ->get();
    }

    public function deleteUser($id){
        return  DB::table('users')->where("idUser","=",$id)->delete();
    }

    public function getRole(){
        return DB::table('roles')->select("idRole", "name")->get();
    }

    public function updateUser($id,$name,$lastName,$email,$phone,$address,$role){
        return DB::table('users')
            ->where("idUser","=",$id)
            ->update(["firstName"=>$name,"lastName"=>$lastName,"email"=>$email, "phone"=>$phone,"address"=>$address,"idRole"=>$role]);
    }

    public function updateUserByUser($id,$name,$lastName,$email,$phone,$address){
        return DB::table('users')
            ->where("idUser","=",$id)
            ->update(["firstName"=>$name,"lastName"=>$lastName,"email"=>$email, "phone"=>$phone,"address"=>$address]);
    }

    public function checkEmailUser($email){
        return DB::table("users")->where("email", "=", $email)->count();
    }

    public function allDocs(){
        return DB::table("vets AS v")
            ->join('users AS u', 'v.idUser', '=', 'u.idUser')
            ->select("idVet", "firstName", "lastName", "email", "licence")
            ->where([
                ['idRole', '=', '2']
            ])
            ->get();
    }
}

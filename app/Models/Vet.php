<?php


namespace App\Models;


use Illuminate\Support\Facades\DB;

class Vet
{
    public function getVet($idV){
        return DB::table("vets")
            ->join('users', 'vets.idUser', '=', 'users.idUser')
            ->select('idVet')
            ->where([
                ["users.idUser", "=", $idV]
            ])
            ->first();
    }
}

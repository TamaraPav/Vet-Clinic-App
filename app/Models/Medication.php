<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Medication extends Model
{
    use HasFactory;

    public function getAllMeds(){
        return DB::table('medications')->get();
    }
    public function storeMed($name){
        return DB::table('medications')->insertGetId(['name'=>$name]);
    }
}

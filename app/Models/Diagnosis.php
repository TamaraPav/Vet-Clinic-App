<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Diagnosis extends Model
{
    use HasFactory;

    public function getAllDiagnosis(){
        return DB::table('diagnosis')->get();
    }

    public function storeDg($name){
        return DB::table('diagnosis')->insertGetId(['name'=>$name]);
    }
}

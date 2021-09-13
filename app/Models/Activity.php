<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ["idUser", "ip", "activity", "date"];

    public function insert($idUser,$ip,$activity,$date){
        return DB::table('activities')->insert(["idUser"=>$idUser,"ip"=>$ip,"activity"=>$activity,"date"=>$date]);
    }

    public static function getActivities($order = 0){
        if($order){
            return Activity::orderBy('date',$order);
        }else{
            return Activity::orderBy('id','asc');
        }
    }

}

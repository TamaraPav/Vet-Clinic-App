<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Images extends Model
{
    use HasFactory;
    public static function uploadImage($image){
        $path = Storage::disk('public')->putFile('assets/images/pets', $image);
        $exploded = explode('/', $path);
        $id = DB::table('images')->insertGetId(["image"=>$exploded[count($exploded) - 1], 'alt'=>'pet']);
        return $id;
    }

    public static function deleteImage($image){
        Storage::disk('public')->delete('assets/images/pets/' . $image);
    }
}

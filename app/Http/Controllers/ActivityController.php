<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends OsnovniController
{
    public function index(){
        $this->data["activities"] = Activity::getActivities()->paginate(10);

        if(!session('user') || (session('user')->idRole != 1 )){
            return  abort('403');
        }

        return view('pages.admin.activity', $this->data);

    }

    public function sort(Request $request){
        $order = $request->order;
        $result = Activity::getActivities($order)->paginate(10);
        return response()->json($result);
    }
}

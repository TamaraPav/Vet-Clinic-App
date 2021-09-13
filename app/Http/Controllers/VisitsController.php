<?php


namespace App\Http\Controllers;


use App\Http\Requests\StringRequest;
use App\Http\Requests\VisitRequest;
use App\Models\Activity;
use App\Models\Appointment;
use App\Models\Diagnosis;
use App\Models\Medication;
use App\Models\Pet;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitsController extends OsnovniController
{
    public function addVisit($idApp, $idPet){

        $modelM = new Medication();
        $resM = $modelM->getAllMeds();

        $modelD = new Diagnosis();
        $resD = $modelD->getAllDiagnosis();

        $modelA = new Appointment();
        $resA = $modelA->getAppForVisit($idApp);

        $modelP = new Pet();
        $resP = $modelP->getPetForVisit($idPet);


        $this->data["meds"] = $resM;
        $this->data["dg"] = $resD;
        $this->data["appointment"] = $resA;
        $this->data["pet"] = $resP;

        return view('pages.vets.addVisit', $this->data);

    }

    public function showMeds(){
        $modelM = new Medication();
        $resM = $modelM->getAllMeds();
        $this->data["meds"] = $resM;
        return view('pages.admin.medications', $this->data);
    }

    public function showDiagnosis(){
        $modelD = new Diagnosis();
        $resD = $modelD->getAllDiagnosis();
        $this->data["dgs"] = $resD;
        return view('pages.admin.diagnosis', $this->data);
    }

    public function storeVisit(VisitRequest $request)
    {
        $idApp = $request->input('app');
        $dg = $request->input('diagnose');
        $med = $request->input('medication');
        $qty = $request->input('qty');
        $summ = $request->input('summ');

        $modelV = new Visit();
        $results = $modelV->insertVisit($dg, $med, $qty, $idApp, $summ);
        if ($results) {
            if (session()->has('user')) {
                $userActivity = new Activity();
                $user = session()->get("user");
                $ip = request()->ip();
                $date = date("Y-m-d H:i:s");
                $activity = "Visit added";
                $userActivity->insert($user->idUser, $ip, $activity, $date);
            }

            $modelA = new Appointment();
            $res = $modelA->updateAppo($idApp);
            //dd($res);
            return redirect()->back()->with('message', 'The visit has been added!');
        } else {
            return redirect()->back()->with("message", "The visit is not added!");
        }
    }

    public function addMed(StringRequest $request){
        $name = $request->input('name');

        $modelM = new Medication();
        $result = $modelM->storeMed($name);

        if($result){
            if (session()->has('user')) {
                $userActivity = new Activity();
                $user = session()->get("user");
                $ip = request()->ip();
                $date = date("Y-m-d H:i:s");
                $activity = "Medication added";
                $userActivity->insert($user->idUser, $ip, $activity, $date);
            }
            return redirect()->back()->with('message', 'The medication has been added!');
        }
        else{
            return redirect()->back()->with("message", "The medication is not added!");
        }
    }


    public function addDg(StringRequest $request){
        $name = $request->input('name');

        $modelM = new Diagnosis();
        $result = $modelM->storeDg($name);

        if($result){
            if (session()->has('user')) {
                $userActivity = new Activity();
                $user = session()->get("user");
                $ip = request()->ip();
                $date = date("Y-m-d H:i:s");
                $activity = "Diagnose added";
                $userActivity->insert($user->idUser, $ip, $activity, $date);
            }
            return redirect()->back()->with('message', 'The diagnose has been added!');
        }
        else{
            return redirect()->back()->with("message", "The diagnose is not added!");
        }
    }

    public function deleteMed(Request $request){
        $id = $request->input('id');
        $results = DB::table('medications')->where("idMedication",$id)->delete();
        if($results){
            if(session()->has('user')){
                $userActivity=new Activity();
                $user=session()->get("user");
                $ip=request()->ip();
                $date=date("Y-m-d H:i:s");
                $activity="Medication deleted";
                $userActivity->insert($user->idUser,$ip,$activity,$date);
            }
            return response()->json(['data'=>"Medication deleted"]);
        } else {
            return response()->json(['data'=>'Medication is not deleted!']);
        }
    }

    public function deleteDg(Request $request){
        $id = $request->input('id');
        $results = DB::table('diagnosis')->where("idDiagnosis",$id)->delete();
        if($results){
            if(session()->has('user')){
                $userActivity=new Activity();
                $user=session()->get("user");
                $ip=request()->ip();
                $date=date("Y-m-d H:i:s");
                $activity="Diagnose deleted";
                $userActivity->insert($user->idUser,$ip,$activity,$date);
            }
            return response()->json(['data'=>"Diagnose deleted"]);
        } else {
            return response()->json(['data'=>'Diagnose is not deleted!']);
        }
    }

}

<?php


namespace App\Http\Controllers;


use App\Http\Requests\AppointmentRequest;
use App\Models\Activity;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Vet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentsController extends OsnovniController
{
    public function showAppToday(Request $request){
        //$date = Carbon::now()->format('Y-m-d');
        $done = $request->app;
        $date = '2021-05-10';  //OVDE SAM STAVILA ODREDJENI DATUM KAKO BISTE VIDELI PODATKE, DA NE BI DOSLO DO SITUACIJE DA NA DAN KADA PREGLEDATE SAJT NEMA ZAKAZANIH PREGLEDA
        $id = session()->get('user')->idUser;
        $appointments = new Appointment();
        $appQuery = $appointments->getAppointments($id, $date, $done);

        return response()->json($appQuery);

    }

    public function addApp($petId){
        $modelA = new Appointment();
        $docs = $modelA->getAllDocs();
        $modelP = new Pet();
        $pet = $modelP->petForEdit($petId);
        $this->data["docs"] = $docs;
        $this->data["pet"] = $pet;
        if(session()->get('user')->idRole == '3'){
            return view('pages.users.addAppointment', $this->data);
        }
        else{
            return view('pages.vets.addAppointment', $this->data);
        }

    }

    public function storeApp(AppointmentRequest $request){
        $id = session()->get('user')->idRole;

        if(session('user')->idRole == 2) {
            $idV =session()->get('user')->idUser;
            $model = new Vet();
            $result = $model->getVet($idV);
            $idVet = $result->idVet;
            //dd($idVet);
        }
        else{
            $idVet = $request->input('vet');
        }
        $date = $request->input('date');
        $time = $request->input('time');
        $note = $request->input('note');
        $approve = $request->input('approve');
        $completed = $request->input('completed');
        $idPet = $request->input('pet');

        $modelP = new Appointment();
        $check = $modelP->checkIfAvailable($date, $time)->count();

        $current = Carbon::now()->format('Y-m-d');

        if($date <= $current){
            return redirect()->back()->with('message','You cannot schedule an appointment in the past or for today!');
        }
        if($check != 0){
            return redirect()->back()->with('message','This appointment is not available!');
        }
        else{
            $results = $modelP->insertAppointment($idPet,$idVet,$date,$time,$note,$approve,$completed);
            if($results){
                if(session()->has('user')){
                    $userActivity=new Activity();
                    $user=session()->get("user");
                    $ip=request()->ip();
                    $date=date("Y-m-d H:i:s");
                    $activity="Appointment added";
                    $userActivity->insert($user->idUser,$ip,$activity,$date);
                }
                if($id == '3'){
                    return redirect()->back()->with('message','Your request is send to admin. He will approve it shortly!');
                }
                else{
                    return redirect()->back()->with('message','Your appointment is scheduled!');
                }
            } else {
                return redirect()->back()->with("message", "The appointment is not added!");
            }
        }
    }

    public function destroy($id){
        $results = DB::table('appointments')->where("idApp",$id)->delete();
        if($results){
            if(session()->has('user')){
                $userActivity=new Activity();
                $user=session()->get("user");
                $ip=request()->ip();
                $date=date("Y-m-d H:i:s");
                $activity="Appointment deleted";
                $userActivity->insert($user->idUser,$ip,$activity,$date);
            }
            return redirect()->back()->with('message','Your appointment is deleted!');
        } else {
            return redirect()->back()->with("message", "The appointment is not deleted!");
        }
    }

    public function apps(){
        $modelA = new Appointment();
        $result = $modelA->getAppForApprovement();

        $this->data['apps'] = $result;
        return view('pages.admin.appointments', $this->data);
    }

    public function approve(Request $request){
        $id = $request->id;
        //dd($id);
        $modelA = new Appointment();
        $result = $modelA->updateApp($id);

        if($result){
            return redirect()->back()->with('message','The appointment has been approved!');
        }else {
            return redirect("/")->with("message", "The appointment is not approved!");
        }

    }

    public function decline(Request $request){
        $id = $request->id;
        $modelA = new Appointment();
        $result = $modelA->deleteApp($id);

        if($result){
            return redirect()->back()->with('message','The appointment has been declined! Contact user to give them more information!');
        }else {
            return redirect("/")->with("message", "The appointment is not declined!");
        }
    }
}

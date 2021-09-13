<?php


namespace App\Http\Controllers;


use App\Http\Requests\PetRequest;
use App\Http\Requests\StringRequest;
use App\Models\Activity;
use App\Models\Appointment;
use App\Models\Images;
use App\Models\Korisnik;
use App\Models\Pet;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetController extends OsnovniController
{
    public function showPet($pet){
        $modelP = new Pet();
        $onePet = $modelP->getPet($pet);
        $this->data["onePet"] = $onePet;


        $modelV = new Visit();
        $visits = $modelV->getVisitsOfPet($pet);
        $this->data["visits"] = $visits;

        $modelA = new Appointment();
        $apps = $modelA->getAppointmentsOfPet($pet);
        //dd($apps);
        $this->data["appointments"] = $apps;
        //dd($visits);
        return view('pages.users.pet', $this->data);
    }

    public function addPet(){
        $modelT = new Pet();
        $type = $modelT->getAllTypes();
        $this->data["types"] = $type;
        return view('pages.users.create', $this->data);
    }

    public function storePet(PetRequest $request){
        //$modelI = new Images();
        $image = Images::uploadImage($request->image);
        if(session('user')->idRole == 3){
            $idOwner = session()->get('user')->idUser;
        }
        else {
            $idOwner = $request->input('owner');
        }
        $idSex = $request->input('gender',true);
        $idType = $request->input('type');
        //dd($idType);
        $name = $request->input('petName');
        $bloodType = $request->input('bloodType');
        $dob = $request->input('dob');

        $current = Carbon::now()->format('Y-m-d');

        if($dob > $current){
            return redirect()->back()->with('message','You cannot add a pet that has not been born yet!');
        }
        $allergies = $request->input('allergies');

        $modelP = new Pet();

        $results = $modelP->insertPet($idOwner,$idType,$image,$name,$idSex,$bloodType,$dob,$allergies);

        if($results){
            if(session()->has('user')){
                $userActivity=new Activity();
                $user=session()->get("user");
                $ip=request()->ip();
                $date=date("Y-m-d H:i:s");
                $activity="Pet Added";
                $userActivity->insert($user->idUser,$ip,$activity,$date);
            }
            if(session('user')->idRole == 1){
                return \redirect("/admin/pets")->with("message", "You have successfully added new pet!");
            }
            return \redirect("/user")->with("message", "You have successfully added new pet!");
        } else {
            return redirect()->back()->with("message", "The pet is not added!");
        }

    }
    public function editPet($petId){
        $modelP = new Pet();
        //dd($petId);
        $pet = $modelP->petForEdit($petId);
        $this->data['pet'] = $pet;
        //dd($this->data['pet']);

        if(session('user')->idRole == 1){

            $modelU = new Korisnik();
            $result = $modelU->getAllUser();
            $this->data['users'] = $result;
            return view('pages.admin.editPet', $this->data);
        }
        return view('pages.users.edit', $this->data);

    }

    public function updatePet(PetRequest $request){
        $id=$request->input('id');
        $idImage=$request->input('idImage');
        //dd($idImage);
        $name = $request->input('petName');
        $oldImage = Images::deleteImage($idImage);
        $image = Images::uploadImage($request->image);
        //dd($image);
        $bloodType = $request->input('bloodType');
        $dob = $request->input('dob');
        $allergies = $request->input('allergies');
        if(session('user')->idRole == 1){
            $idOwner = $request->input('owner');
        }
        else{
            $idOwner = session('user')->idUser;
        }
        $current = Carbon::now()->format('Y-m-d');

        if($dob > $current){
            return redirect()->back()->with('message','You cannot add a pet that has not been born yet!');
        }

        $modelU = new Pet();
        $result = $modelU->updatePett($id,$idOwner, $image, $name, $bloodType, $dob, $allergies);
        //dd($result);
        if ($result) {
            if (session()->has('user')) {
                $userActivity = new Activity();
                $user = session()->get("user");
                $ip = request()->ip();
                $date = date("Y-m-d H:i:s");
                $activity = "Pet Info Updated";
                $userActivity->insert($user->idUser, $ip, $activity, $date);
            }
            if(session('user')->idRole == 1){
                return \redirect("/admin/pets")->with("message", "You have successfully updated pet info!");
            }else{
                return \redirect("/user")->with("message", "You have successfully updated pet info!");
            }

        } else {
            return redirect()->back()->with("message", "Pet info is not updated!");
        }
    }
    public function deletePet(Request $request){
        $id = $request->input('id');
        //dd($id);
        $results = DB::table('pets')->where("idPet",$id)->delete();
        if($results){
            if(session()->has('user')){
                $userActivity=new Activity();
                $user=session()->get("user");
                $ip=request()->ip();
                $date=date("Y-m-d H:i:s");
                $activity="Appointment deleted";
                $userActivity->insert($user->idUser,$ip,$activity,$date);
            }
            return response()->json(['data'=>"Pet is deleted"]);
        } else {
            return response()->json(['data'=>"Pet is not deleted"]);
        }
    }

    public function showPetTypes(){
        $modelP = new Pet();
        $types = $modelP->getAllTypes();
        $this->data["types"] = $types;
        return view('pages.admin.pettypes', $this->data);
    }

    public function showAllPets(){
        $modelP = new Pet();
        $result1 = $modelP->getAllPets();
        $modelU = new Korisnik();
        $result2 = $modelU->getAllUser();
        $modelT = new Pet();
        $type = $modelT->getAllTypes();

        $this->data["types"] = $type;
        $this->data["pets"] = $result1;
        $this->data["users"] = $result2;
        return view('pages.admin.pets', $this->data);
    }

    public function addType(StringRequest $request){
        $name = $request->input('name');

        $modelM = new Pet();
        $result = $modelM->storeType($name);

        if($result){
            if (session()->has('user')) {
                $userActivity = new Activity();
                $user = session()->get("user");
                $ip = request()->ip();
                $date = date("Y-m-d H:i:s");
                $activity = "Diagnose added";
                $userActivity->insert($user->idUser, $ip, $activity, $date);
            }
            return redirect()->back()->with('message', 'The pet type has been added!');
        }
        else{
            return redirect()->back()->with("message", "The pet type is not added!");
        }
    }

    public function deleteType(Request $request){
        $id = $request->input('id');
        $results = DB::table('pettypes')->where("idType",$id)->delete();
        if($results){
            if(session()->has('user')){
                $userActivity=new Activity();
                $user=session()->get("user");
                $ip=request()->ip();
                $date=date("Y-m-d H:i:s");
                $activity="Pet type deleted";
                $userActivity->insert($user->idUser,$ip,$activity,$date);
            }
            return response()->json(['data'=>"Pet type deleted"]);
        } else {
            return response()->json(['data'=>'Pet type is not deleted!']);
        }
    }

    public function searchPet(Request $request){
        $search= $request->get('search');

        $modelP = new Pet();
        $result = $modelP->searchPet($search);

        return response()->json($result);
    }
}

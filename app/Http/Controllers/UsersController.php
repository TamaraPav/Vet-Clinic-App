<?php


namespace App\Http\Controllers;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Activity;
use App\Models\Korisnik;
use App\Models\Pet;
use Illuminate\Http\Request;

class UsersController extends OsnovniController
{

    public function index(){
        $id = session()->get('user')->idUser;
        $modelP = new Pet();
        $pets = $modelP->getPets($id);
        $this->data['pets'] = $pets;
        //dd($pets);

        $modelK = new Korisnik();
        $korisnik = $modelK->getUserWithId($id);
        $this->data['user']= $korisnik;

        return view('pages.users.main',$this->data);

    }

    public function editUser(Request $request){
        if(session('user')->idRole == 1){
            $id = $request->id;
            //dd($id);
        }
        else{
            $id = session()->get('user')->idUser;
        }
        $modelU = new Korisnik();
        $user = $modelU->getUserWithId($id);
        $this->data['korisnik'] = $user;
        //dd($this->data['korisnik']);

        if(session('user')->idRole == 1){
            return view('pages.admin.editUser', $this->data);
        }
        else{
            return view('pages.users.editUser', $this->data);
        }


    }

    public function updateUser(UpdateUserRequest $request, Korisnik $korisnik)
    {
        if(session()->get('user')->idRole == 1){
            $id = $request->id;
        }
        else{
            $id = session()->get('user')->idUser;
        }
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $role = $request->input('role');

        $modelU = new Korisnik();
        if(session('user')->idRole == 1){
            $result = $modelU->updateUser($id,$firstName,$lastName,$email,$phone,$address,$role);
        }
        else{
            $result = $modelU->updateUserByUser($id, $firstName, $lastName, $email, $phone, $address);
        }
        //dd($result);
        if ($result) {
            if (session()->has('user')) {
                $userActivity = new Activity();
                $user = session()->get("user");
                $ip = request()->ip();
                $date = date("Y-m-d H:i:s");
                $activity = "User Info Updated";
                $userActivity->insert($user->idUser, $ip, $activity, $date);
            }
            if(session('user')->idRole == 1){
                return response()->json(['message','User is updated!']);
            }
            else{
                return \redirect("/user")->with("message", "You have successfully updated your info!");
            }
        } else {
            return redirect("/user")->with("message", "Your info is not updated!");
        }
    }

    public function showAllUsers(){
        $modelU = new Korisnik();
        $result = $modelU->getAllUser();
//dd($result);
        $this->data['users'] = $result;
        return view('pages.admin.users', $this->data);
    }

    public function addNewUser(Request $request){

        $firstName=$request->input('fName');
        $lastName=$request->input('lName');
        $email=$request->input('email');
        $password=$request->input('password');
        $address=$request->input('address');
        $phone=$request->input('phone');
        $role=$request->input('role');
        //dd($firstName, $lastName, $email,$password, $phone, $address, $role);
        $modelU = new Korisnik();
        $result = $modelU->insertUser($firstName, $lastName, $email,$password, $phone, $address, $role);

        if($result){
            return \redirect("/admin/users")->with("message", "You have added new user!");
        } else {
            return redirect()->back()->with("message", "The user is not added!");
        }

    }
    public function deleteUser(Request $request){
        $id = $request->id;
        //dd($id);
        $modelU = new Korisnik();
        $result = $modelU->deleteUser($id);
        //dd($result);
        if($result){
            return \redirect("/admin/users")->with("message", "You have deleted the user!");
        } else {
            return redirect()->back()->with("message", "The user is not added!");
        }
    }
}

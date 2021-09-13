<?php


namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Activity;
use App\Models\Korisnik;
use Illuminate\Http\Request;


class HomeController extends OsnovniController
{

    public function index()
    {
        return view('pages.main.home', $this->data);
    }

    public function login(LoginRequest $request){
        $loginEmail=$request->input('emailLog');
        $password=$request->input('passwordLog');
        $loginPassword = md5($password);
        try{
            $model = new Korisnik();
            $user=$model->getUser($loginEmail,$loginPassword);

            if($user) {
                $request->session()->put("user", $user);
                $user=session()->get("user");

                if(session()->has("user")){
                    $userActivity=new Activity();
                    $user=session()->get("user");
                    $ip=request()->ip();
                    $activity="login";
                    $date=date("Y-m-d H:i:s");
                    $userActivity->insert($user->idUser,$ip,$activity,$date);
                }
                if($user->idRole==3){
                    return redirect()->route('user');
                }else if($user->idRole==2){
                    return redirect()->route('doctor');
                }else{
                    return redirect()->route('admin');
                }
            } else {
            return redirect("/")->with("message", "The email or password is not correct!");
            }
        }catch(\Exception $ex) {
            return redirect()->back()->with('message','Database error.');
            //Log::error($ex->getMessage());
        }
    }

    public function logout(Request $request){
        if(session()->has('user')){
            $userActivity=new Activity();
            $user=session()->get("user");
            $ip=request()->ip();
            $date=date("Y-m-d H:i:s");
            $activity="logout";
            $userActivity->insert($user->idUser,$ip,$activity,$date);
        }
        $request->session()->forget("user");
        $request->session()->flush();
        return redirect("/")->with("message", "You logged out");
    }

    public function register(Request $request){

        $firstName=$request->input('firstName');
        $lastName=$request->input('lastName');
        $email=$request->input('email');
        $password=$request->input('password');
        $repPassword=$request->input('repPass');
        $address=$request->input('address');
        $phone=$request->input('telephone');
        $role='3';
        //dd($firstName, $lastName, $email, $password, $repPassword, $address, $phone);
        if($password!=$repPassword){
            return \redirect("/")->with("message", "Repeat Password error!");
        }else{

            $model= new Korisnik();

            $checkEmail=$model->checkEmailUser($email);

            if($checkEmail!=0){
                return \redirect("/")->with("message", "User with this email already exist, try to log in!");
            }
            $pass = md5($password);
            $userId=$model->insertUser($firstName,$lastName,$email,$pass,$phone,$address,$role);
            $results=$model->getUserWithId($userId);

            if($results){
                $request->session()->put("user", $results);
                if(session()->has('user')){
                    $userActivity=new Activity();
                    $user=session()->get("user");
                    $ip=request()->ip();
                    $date=date("Y-m-d H:i:s");
                    $activity="Registered";
                    $userActivity->insert($user->idUser,$ip,$activity,$date);
                }
                return \redirect("/user")->with("message", "You have successfully registered!");
            } else {
                return redirect("/")->with("message", "You are not registered!");
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends OsnovniController
{
    public function contact(){
        return view('pages.contact.contact', $this->data);
    }

    public function author(){
        return view('pages.contact.author', $this->data);
    }

    public function contactAdmin(ContactRequest $request){

        $name = $request->input("cf-name");
        $email = $request->input("cf-email");
        $subj = $request->input("cf-subject");
        $msg = $request->input("cf-message");

        try{
            $data = array('name'=> $name, 'email'=> $email,"poruka" => $msg);
            Mail::send('pages.contact.sendMail', $data, function($message) use ($name, $email, $subj) {
                $message->to('t.pavlovic996@gmail.com', 'Admin')->subject($subj);
                $message->from($email,$name);
            });
            return redirect()->back()->with('message','Message sent successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('message','Message not sent!');
        }
    }
}

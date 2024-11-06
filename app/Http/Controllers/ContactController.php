<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; 
use App\Mail\ContactMail;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(){
        return view('contact.contact');
    }
     
    public function SendMail(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject'=>'required',
            'message' => 'required',
        ]);

        $Mail = [
            'name' => $request->name,
            'email' => $request->email,
            'subject'=> $request->subject,
            'message' => $request->message,
        ];

        $mail=Mail::to('noelivankie@gmail.com')->send(new ContactMail($Mail));

        if ($mail) {

            Contact::create([
            'name' => $Mail['name'],
            'email' => $Mail['email'],
            'subject' => $Mail['subject'],
            'message' => $Mail['message'],
            ]);
        }
        else{
            echo 'erreur';
        }

        return back()->with('message', 'Email sent successfully!');

    }
 
}

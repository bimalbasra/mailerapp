<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactUsFormController extends Controller {

  
    public function createForm(Request $request) {
      return view('contact');
    }

    // Store Data 
    public function ContactUsForm(Request $request) {

        //Valdiation 
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject'=>'required',
            'message' => 'required'
         ]);

        // Add To Database
        Contact::create($request->all());

        //SendMail
        Mail::send('mail', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'subject' => $request->get('subject'),
            'user_query' => $request->get('message'),
        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('bimalbasra98@gmail.com', 'Admin')->subject($request->get('subject'));
        });

        return back()->with('Messege Success!');
    }

}

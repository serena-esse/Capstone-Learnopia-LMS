<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function showContactForm()
    {
        return view('contact.form');
    }



public function submitContactForm(Request $request)
{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|string',
            ]);

            $details = [
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
            ];

            Mail::to('salma.yousry.alhosary@gmail.com')->send(new ContactMail($details));

            return back()->with('success', 'Your message has been sent successfully!');
        } 
    }




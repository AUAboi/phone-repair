<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'subject' => 'required|string',
            'phone' => 'required|phone:' . config('constants.phone_number'),
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $contact = [
            'name' => $request->name,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ];

        try {
            Mail::to("sales@fonemartonline.com")->send(new ContactForm($contact));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Sent successfully');
    }
}

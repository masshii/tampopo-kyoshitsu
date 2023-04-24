<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(ContactRequest $request)
    {
        $contact = new Contact();
        $contact->title = $request->title;
        $contact->body = $request->body;
        $contact->email = $request->email;
        $contact->save();

        Mail::to(config('mail.admin'))->send(new ContactForm($contact));
        Mail::to($contact['email'])->send(new ContactForm($contact));

        return redirect()->route('contact.create')->with('message', 'メールを送信しました');
    }
}

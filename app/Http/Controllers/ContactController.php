<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormMail;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(ContactRequest $request)
    {
        // Save to database
        $message = ContactMessage::create($request->validated());

        // Send email notification (uncomment when mail is configured)
        // Mail::to(config('mail.contact_to'))->send(new ContactFormMail($message));

        return redirect()
            ->route('contact')
            ->with('success', 'Your message has been sent! We will get back to you shortly.');
    }
}
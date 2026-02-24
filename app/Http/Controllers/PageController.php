<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function contactUs()
    {
        return view('pages.contact-page');
    }

    public function privacy()
    {
        return view('pages.privacy-policy-page');
    }

    public function termsConditions()
    {
        return view('pages.terms-conditiions');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
            'g-recaptcha-response' => 'required',
        ]);

        // CAPTCHA verification
        $captcha = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => config('services.recaptcha.secret'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]
        )->json();

        if (! ($captcha['success'] ?? false)) {
            return back()->withErrors(['captcha' => 'Captcha verification failed']);
        }

        Mail::to(config('mail.from.address'))->send(
            new ContactFormMail(
                $request->name,
                $request->email,
                $request->message
            )
        );

        return back()->with('success', 'Message sent successfully!');
    }
}

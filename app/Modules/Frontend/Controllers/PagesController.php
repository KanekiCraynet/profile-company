<?php

namespace App\Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function about()
    {
        $page = Page::where('slug', 'about')->first();

        return view('frontend.pages.about', compact('page'));
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Rate limiting: max 5 submissions per minute
        $recentSubmissions = Contact::where('ip_address', $request->ip())
            ->where('created_at', '>=', now()->subMinute())
            ->count();

        if ($recentSubmissions >= 5) {
            return back()->withErrors(['message' => 'Too many submissions. Please wait a minute before submitting again.']);
        }

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Send email notification to admins
        // You can implement email notification here

        return back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
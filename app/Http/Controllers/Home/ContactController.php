<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'subject' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:20',
            'message' => 'nullable|string|max:255',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Your message submitted successfully.');
    }

    public function show()
    {
        $contacts = Contact::latest()->get();

        return view('admin.contact.index', compact('contacts'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->back()->with('success', 'Contact message deleted successfully.');
    }
}

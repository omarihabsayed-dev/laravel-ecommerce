<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $footer = Footer::findOrFail(1);

        return view('admin.footer.index', compact('footer'));
    }

    public function update(Request $request)
    {
        $footer = Footer::findOrFail(1);
        $validated = $request->validate([
            'number' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'copyright' => 'nullable|string|max:255',
        ]);

        $footer->update($validated);

        return redirect()->route('footer.index')->with('success', 'Footer updated successfully.');
    }
}

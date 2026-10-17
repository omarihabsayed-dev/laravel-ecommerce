<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }

    public function profile()
    {

        $user = auth()->user();

        return view('admin.profile', compact('user'));
    }

    public function edit()
    {

        $user = auth()->user();

        return view('admin.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $validated['profile_image'] = $request->file('profile_image')->store('images', 'public');
        }

        $user->update($validated);

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    public function changePassword()
    {
        return view('admin.change-password');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'oldpassword' => ['required', 'current_password:web'],
            'newpassword' => ['required', 'string', 'min:8', 'different:oldpassword'],
            'confirm_password' => ['required', 'same:newpassword'],
        ]);
        $user->password = Hash::make($request->newpassword);
        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Password updated successfully.');
    }
}

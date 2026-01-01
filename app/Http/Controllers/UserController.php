<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AccountUpdated; // Import your Mailable
use Illuminate\Support\Facades\Mail; // Import Mail Facade
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function settingsForm()
    {
        return view('auth.settings');
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        
        Mail::to($validated['email'])->send(new AccountUpdated($user));

        return back()->with('status', 'Account info updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        $user->update(['password' => $validated['password']]);
        Mail::to($user->email)->send(new AccountUpdated($user));
        return back()->with('status', 'Password updated successfully.');
    }
}
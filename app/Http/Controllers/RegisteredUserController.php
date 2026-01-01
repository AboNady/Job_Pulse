<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Import Hash
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;   // Import DB for transactions
use Illuminate\Validation\Rules;     // Import Password Rules

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // 1. Combine Validation
        // Validating everything at once provides better UX (shows all errors together).
        $attributes = $request->validate([
            // User Details
            'name'             => ['required', 'string', 'max:255'],
            'email'            => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'         => ['required', 'confirmed', Rules\Password::defaults()],

            // Employer Details
            'employer_name'    => ['required', 'string', 'max:255'],
            'employer_email'   => ['required', 'string', 'email', 'max:255', 'unique:employers,email'],
            'employer_phone'   => ['required', 'string', 'max:20'],
            'employer_address' => ['required', 'string', 'max:255'],
            'employer_logo'    => ['required', 'image', 'max:4048'],
        ]);

        // 2. Database Transaction
        // This ensures that if the Employer creation fails, the User is NOT created.
        // It keeps your database clean.
        $user = DB::transaction(function () use ($request, $attributes) {
            
            // A. Create User
            $user = User::create([
                'name'     => $attributes['name'],
                'email'    => $attributes['email'],
                'password' => Hash::make($attributes['password']), // SECURITY FIX: Hash the password
            ]);

            // B. Handle File Upload
            $logoPath = $request->file('employer_logo')->store('employer_logos', 'public');

            // C. Create Employer
            $user->employer()->create([
                'name'    => $attributes['employer_name'],
                'email'   => $attributes['employer_email'],
                'phone'   => $attributes['employer_phone'],
                'address' => $attributes['employer_address'],
                'logo'    => $logoPath,
            ]);

            return $user;
        });

        // 3. Post-Registration Actions
        // These happen outside the transaction so they don't block the DB if they are slow.
        
        // Triggers the built-in Laravel Email Verification (ensure MustVerifyEmail is on User model)
        $user->sendEmailVerificationNotification();

        Auth::login($user);

        return redirect()->route('index');
    }
}
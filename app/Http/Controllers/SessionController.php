<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; // Better exception handling

class SessionController extends Controller
{
    // ... index and create methods remain the same ...

    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // 1. Validate Input
        $attributes = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Security: Rate Limiting is usually handled by Laravel's "throttle" middleware
        // defined in routes/web.php (e.g., ->middleware('throttle:login')), but 
        // ensure you have that set up in your routes!

        // 3. Attempt to Log In
        // Improvement: Added support for "Remember Me" checkbox
        $remember = $request->boolean('remember');

        if (! Auth::attempt($attributes, $remember)) {
            // Throwing a ValidationException is cleaner than manual back()->withErrors()
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        // 4. Session Fixation Protection
        $request->session()->regenerate();

        // 5. Redirect Intended
        // This sends them back to the page they were trying to visit before being forced to login
        return redirect()->intended('dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        // Security: Invalidate session and regenerate token to prevent CSRF attacks
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
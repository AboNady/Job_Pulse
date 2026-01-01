<?php

namespace App\Http\Controllers;

use App\Models\Job; // Fixed capitalization
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function manage()
    {
        $user = Auth::user();

        // ROBUSTNESS FIX: Check if user is actually an employer first
        if (! $user->employer) {
            abort(403, 'You must be registered as an employer to view this page.');
        }

        $jobs = $user->employer
            ->jobs()
            // Keep this to load tags efficiently
            ->with('tags:id,name') 
            ->latest()
            ->paginate(5);
        return view('dashboard.jobs', compact('jobs'));
    }
}
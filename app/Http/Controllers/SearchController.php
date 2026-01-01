<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $search = $request->input('q');

        $jobs = Job::with(['tags', 'employer']) // FIX 1: Eager load employer to prevent N+1 queries
            ->where(function ($query) use ($search) {
                // We wrap EVERYTHING in this closure. 
                // This isolates the "OR" logic so it doesn't mess up other filters 
                // you might add later (like ->where('status', 'active')).
                
                $query->where('title', 'LIKE', "%{$search}%")
                      ->orWhere('description', 'LIKE', "%{$search}%")
                      ->orWhere('location', 'LIKE', "%{$search}%")
                      ->orWhere('type', 'LIKE', "%{$search}%")
                      // FIX 2: Search tags inside this same group
                      ->orWhereHas('tags', function ($q) use ($search) {
                          $q->where('name', 'LIKE', "%{$search}%");
                      });
            })
            ->latest() // Good to show newest results first
            ->paginate(20); // FIX 3: Always paginate search results

        // Append the search query to the pagination links 
        // (so page 2 knows we are still searching for 'q')
        $jobs->appends(['q' => $search]);

        return view('jobs.results', [
            'jobs' => $jobs, 
            'q'    => $search
        ]);
    }
}
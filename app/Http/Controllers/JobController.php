<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Mail\PostCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class JobController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        // 1. Get Featured Jobs
        $featuredJobs = Cache::remember('featured_jobs', 3600, fn() => 
            Job::with(['employer', 'tags'])
                ->where('is_featured', true)
                ->latest()
                ->take(8)
                ->get()
        );

        // 2. Get All Jobs (Paginated - usually not cached due to complexity)
        $jobs = Job::with(['employer', 'tags'])
            ->latest()
            ->simplePaginate(10); 
        
        // 3. Get Total Count
        $totalJobsCount = Cache::remember('total_jobs_count', 3600, fn() => Job::count());
        
        return view('main.index', [
            'jobs' => $jobs,
            'featuredJobs' => $featuredJobs,
            'tags' => Cache::remember('tags_list', 3600, fn() => Tag::all()),
            'totalJobsCount' => $totalJobsCount
        ]);
    }

    public function create()
    {
        return view('jobs.create', [
            'tags' => Cache::remember('tags_list', 3600, fn() => Tag::all())
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'location'      => 'required|string|max:255',
            'salary'        => 'required|string|max:255',
            'type'          => 'required|string|in:Full-time,Part-time,Contract,Remote',
            'posted_date'   => 'required|date',
            'closing_date'  => 'required|date|after_or_equal:posted_date',
            'url'           => 'nullable|url|max:255',
            'is_featured'   => 'sometimes|boolean',
            'logo'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags'          => 'sometimes|array',
            'tags.*'        => 'integer|exists:tags,id',
        ]);
        
        $user = Auth::user();
        $logoPath = $request->file('logo')->store('logos', 'public');

        $job = Job::create([
            'employer_id'  => $user->employer->id,
            'title'        => $validated['title'],
            'description'  => $validated['description'],
            'location'     => $validated['location'],
            'salary'       => $validated['salary'],
            'type'         => $validated['type'],
            'posted_date'  => $validated['posted_date'],
            'closing_date' => $validated['closing_date'],
            'url'          => $validated['url'] ?? null,
            'logo'         => $logoPath,
            'is_featured'  => $validated['is_featured'] ?? false,
        ]);

        if (! empty($validated['tags'])) {
            $job->tags()->sync($validated['tags']);
        }

        // Email Queue
        Mail::to($user->email)->queue(new PostCreated($user, $job));

        // Clear general caches
        $this->clearJobCache();

        return redirect()->route('index')->with('success', 'Job posted successfully!');
    }

    /**
     * ✅ UPDATED: Changed from `show(Job $job)` to `show($id)`
     * This allows us to Cache the result before the database is hit.
     */
    public function show($id)
    {
        // Cache the specific job for 1 hour (3600s)
        // Key is unique per job: "job_1", "job_2", etc.
        $job = Cache::remember("job_{$id}", 3600, function () use ($id) {
            return Job::with(['employer', 'tags'])->findOrFail($id);
        });

        return view('jobs.show', ['job' => $job]);
    }

    public function edit(Job $job)
    {
        return view('jobs.update', [
            'job'  => $job,
            'tags' => Cache::remember('tags_list', 3600, fn() => Tag::all()),
        ]);
    }

    public function update(Request $request, Job $job)
    {
        if ($request->user()->employer->id !== $job->employer_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'location'      => 'required|string|max:255',
            'salary'        => 'required|string|max:255',
            'type'          => 'required|string|in:Full-time,Part-time,Contract,Remote',
            'posted_date'   => 'required|date',
            'closing_date'  => 'required|date|after_or_equal:posted_date',
            'url'           => 'nullable|url|max:255',
            'is_featured'   => 'sometimes|boolean',
            'logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags'          => 'sometimes|array',
            'tags.*'        => 'integer|exists:tags,id',
        ]);

        $logoPath = $job->logo;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $job->update([
            'title'        => $validated['title'],
            'description'  => $validated['description'],
            'location'     => $validated['location'],
            'salary'       => $validated['salary'],
            'type'         => $validated['type'],
            'posted_date'  => $validated['posted_date'],
            'closing_date' => $validated['closing_date'],
            'url'          => $validated['url'] ?? null,
            'logo'         => $logoPath,
            'is_featured'  => $validated['is_featured'] ?? false,
        ]);

        if (isset($validated['tags'])) {
            $job->tags()->sync($validated['tags']);
        }

        // ✅ BETTER: Clear the cache for THIS specific job
        $this->clearJobCache($job->id);

        return redirect()->route('jobs.manage')->with('success', 'Job updated successfully!');
    }

    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);
        
        $id = $job->id; // Save ID before delete to clear cache
        $job->delete();

        // ✅ BETTER: Clear the cache for this deleted ID
        $this->clearJobCache($id);

        return redirect()->route('jobs.manage')->with('success', 'Job deleted successfully.');
    }

    /**
     * Private Helper to clear all job-related caches.
     * @param int|null $specificJobId If provided, clears that specific job's cache too.
     */
    private function clearJobCache($specificJobId = null)
    {
        // 1. Clear Featured Jobs
        Cache::forget('featured_jobs');

        // 2. Clear Total Count
        Cache::forget('total_jobs_count');

        // 3. Clear Tag List (optional, but safe)
        Cache::forget('tags_list');

        // 4. Clear Specific Job Cache (Essential for 'show' updates)
        if ($specificJobId) {
            Cache::forget("job_{$specificJobId}");
        }
    }
}
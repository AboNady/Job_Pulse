<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Import Rule for cleaner validation

class TagController extends Controller
{
    /**
     * Display jobs associated with a specific tag.
     */
    public function search(Tag $tag)
    {

        $jobs = $tag->jobs()
            ->with(['employer', 'tags']) 
            ->latest()
            ->paginate(12);

        return view('jobs.tags', [
            'jobs' => $jobs,
            'q'    => $tag->name,
        ]);
    }

    /**
     * Dashboard list of tags.
     */
    public function index()
    {
        // PERFORMANCE FIX 3: Removed explicit Tag::count()
        // The paginate() method automatically runs a count query to calculate pages.
        // You can access the total in Blade using {{ $tags->total() }}.

        // BONUS: withCount('jobs')
        // This lets you show "Laravel (54 active jobs)" in your dashboard efficiently.
        $tags = Tag::withCount('jobs')
                   ->orderBy('name')
                   ->paginate(20);

        return view('dashboard.tags', ['tags' => $tags]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        Tag::create($data);

        return redirect()->route('tags.index')
                         ->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        return view('dashboard.tags-edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            // Optimization: Use Rule object for cleaner syntax
            'name' => ['required', 'string', 'max:255', Rule::unique('tags')->ignore($tag->id)],
        ]);

        $tag->update($data);

        return redirect()->route('tags.index')
                         ->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        // Optimization: Ensure pivot table entries are removed 
        // (Laravel usually handles this if cascading deletes are set in DB, 
        // but explicit detach is safer if they aren't).
        $tag->jobs()->detach(); 
        
        $tag->delete();

        return redirect()->route('tags.index')
                         ->with('success', 'Tag deleted successfully.');
    }
}
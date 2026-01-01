<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; // Cleaner validation

class EmployerController extends Controller
{
    public function index(Request $request)
    {
        // PERFORMANCE FIX 1: Select only what you see on the card.
        // This saves memory by not loading huge bio/description text for 12 companies.
        $query = Employer::select(['id', 'user_id', 'name', 'address', 'logo', 'created_at','phone'])
            ->withCount('jobs'); // PERFORMANCE FIX 2: Get job count in 1 query, not 12.

        // Live search
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('address', 'like', '%' . $request->q . '%');
            });
        }

        $companies = $query->latest()->paginate(12);

        return view('companies.index', compact('companies'));
    }

    public function update(Request $request)
    {
        // Optimization: Use $request->user() instead of Auth facade (slightly faster/cleaner)
        $employer = $request->user()->employer;

        $validated = $request->validate([
            'employer_name'    => 'required|string|max:255',
            // Optimization: Ignore current ID in unique check properly
            'employer_email'   => ['required', 'email', Rule::unique('employers', 'email')->ignore($employer->id)],
            'employer_phone'   => 'required|string|max:20',
            'employer_address' => 'required|string|max:255',
            'employer_logo'    => 'nullable|image|max:4048',
        ]);

        // Prepare data for update
        $data = [
            'name'    => $validated['employer_name'],
            'email'   => $validated['employer_email'],
            'phone'   => $validated['employer_phone'],
            'address' => $validated['employer_address'],
        ];

        // Handle File I/O
        if ($request->hasFile('employer_logo')) {
            $newLogoPath = $request->file('employer_logo')->store('logos', 'public');
            
            // Optimization: Delete OLD logo only after NEW one is safely uploaded
            if ($employer->logo) {
                Storage::disk('public')->delete($employer->logo);
            }

            $data['logo'] = $newLogoPath;
        }

        // PERFORMANCE FIX 3: Single DB Update Query
        // Instead of setting property -> save -> property -> save, do it once.
        $employer->update($data);

        return redirect()->route('companies.index')
            ->with('success', 'Company profile updated.');
    }
}
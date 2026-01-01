<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class ChartsController extends Controller
{
    public function salaries()
    {
        // 1. Fetch and Clean Data
        // We get all salaries, strip " EGP" and commas, and convert to integers.
        $salaries = Job::pluck('salary')->map(function ($salary) {
            return (int) preg_replace('/\D/', '', $salary);
        });

        // Handle empty DB case to prevent crash
        if ($salaries->isEmpty()) {
            return view('main.salaries', [
                'labels' => [], 'data' => [],
                'avgSalary' => 0, 'maxSalary' => 0, 'minSalary' => 0
            ]);
        }

        // 2. Calculate Real Statistics (Average, Min, Max)
        // We calculate these in PHP because it is faster and more accurate than JS.
        $avgSalary = round($salaries->avg());
        $maxSalary = $salaries->max();
        $minSalary = $salaries->min();

        // 3. Create Histogram "Buckets" (The Distribution Logic)
        // We group jobs into ranges of 10,000 EGP (e.g., 10k-20k, 20k-30k)
        $step = 10000; 
        
        $distribution = $salaries->map(function ($salary) use ($step) {
            // Round down to nearest step (e.g., 45,600 -> 40,000)
            return floor($salary / $step) * $step;
        })->countBy()->sortKeys();

        // 4. Format Labels and Data for Chart.js
        // Labels: ["10k - 20k", "20k - 30k", ...]
        $labels = $distribution->keys()->map(function ($lowerBound) use ($step) {
            $upperBound = $lowerBound + $step;
            return ($lowerBound / 1000) . 'k - ' . ($upperBound / 1000) . 'k';
        })->values()->toArray();

        // Data: [5, 12, 40, ...] (The number of jobs in each range)
        $data = $distribution->values()->toArray();

        return view('main.salaries', compact('labels', 'data', 'avgSalary', 'maxSalary', 'minSalary'));
    }
}
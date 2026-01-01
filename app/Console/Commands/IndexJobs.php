<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;
use App\Services\VectorService;

class IndexJobs extends Command
{
    // The command you will type in the terminal
    protected $signature = 'index:jobs';

    // Description of what it does
    protected $description = 'Send all jobs to Pinecone for Vector Search';


    public function handle(VectorService $vectorService)
    {
        $total = Job::count();
        $this->info("Batch Indexing {$total} jobs...");
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        // Process 50 jobs at a time
        Job::with('employer')->chunk(50, function ($jobs) use ($vectorService, $bar) {
            try {
                $vectorService->upsertBatch($jobs);
            } catch (\Exception $e) {
                $this->error("Batch failed: " . $e->getMessage());
            }
            $bar->advance(50);
        });

        $bar->finish();
        $this->info("\nDone!");
    }
}
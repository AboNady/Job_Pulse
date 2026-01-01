<?php

namespace App\Observers;

use App\Models\Job;
use App\Services\VectorService;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class JobObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Job "created" event.
     */
    public function created(Job $job): void
    {
        // ✅ Correct way: Resolve the service Lazily using app()
        // This prevents the "2-second delay" on the homepage.
        app(VectorService::class)->upsertJob($job);
    }

    /**
     * Handle the Job "updated" event.
     */
    public function updated(Job $job): void
    {
        // ✅ Correct way: Resolve the service Lazily using app()
        app(VectorService::class)->upsertJob($job);
    }
}

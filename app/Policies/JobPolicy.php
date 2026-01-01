<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;

class JobPolicy
{
    /**
     * Determine whether the user can view any jobs.
     */
    public function viewAny(User $user)
    {
        return true; // anyone logged in can view their own dashboard
    }

    /**
     * Determine whether the user can view a specific job.
     */
    public function view(User $user, Job $job)
    {
        return true; // jobs are public (change if needed)
    }

    /**
     * Determine whether the user can create jobs.
     */
    public function create(User $user)
    {
        return true; // any authenticated user can create
    }

    /**
     * Determine whether the user can update the job.
     */
    public function update(User $user, Job $job)
    {
        return $user->id === $job->employer->user_id;
    }

    /**
     * Determine whether the user can delete the job.
     */
    public function delete(User $user, Job $job)
    {
        return $user->id === $job->employer->user_id;
    }
}

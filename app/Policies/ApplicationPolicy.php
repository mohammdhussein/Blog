<?php

namespace App\Policies;

use App\Models\Applicant;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ApplicationPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User|null $user, Applicant $applicant, Job $job): Response
    {
        $latest = Application::where('applicant_id', $applicant->id)
            ->where('job_id', $job->id)
            ->latest()
            ->first();

        return !($latest && $latest->status !== 'rejected')
            ? Response::allow()
            : Response::deny('You already submitted for this job and are still under review or accepted.');
    }

}

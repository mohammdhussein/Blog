<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\v1\StoreApplicantRequest;
use App\Http\Resources\v1\ApplicationCollection;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\Job;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::all();
        return response()->json([
            'applications' => new ApplicationCollection($applications),
            'status' => 'success',
            'message' => 'Applications retrieved successfully'
        ]);
    }

    public function store(StoreApplicantRequest $request)
    {
        $applicant = Applicant::createOrFirst($request->validated());

        $job = Job::findOrFail($request->job_id);

        $this->authorize('create', [Application::class, $applicant, $job]);

        $application = Application::create([
            'applicant_id' => $applicant->id,
            'job_id' => $job->id,
            'status' => 'pending'
        ]);
        return response()->json([
            'message' => 'Application submitted successfully.',
            'submission' => $application
        ], 201);
    }
}

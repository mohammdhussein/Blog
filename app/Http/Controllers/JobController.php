<?php

namespace App\Http\Controllers;

use App\Http\Requests\v1\StoreJobRequest;
use App\Http\Requests\v1\UpdateJobRequest;
use App\Http\Resources\v1\JobCollection;
use App\Http\Resources\v1\JobResource;
use App\Models\Job;
use Illuminate\Http\JsonResponse;

class JobController extends Controller
{
    public function index(): JobCollection
    {
        $jobs = Job::with('employer')->latest()->paginate(3);
        return new JobCollection($jobs);
    }

    public function show(Job $job): JobResource
    {
        return new JobResource($job);
    }

    public function store(StoreJobRequest $request): JsonResponse
    {
        if (!request()->user()->isEmployer()) {
            return response()->json([
                'message' => 'This User is not Employer'
            ], 422);
        }
        $job = Job::create($request->validateWithUser());
        return response()->json([
            'job' => new JobResource($job),
            'massage' => 'Job created successfully',
            'status' => true
        ], 201);

    }

    public function update(UpdateJobRequest $request, Job $job): JsonResponse
    {
        if ($job->employer->id !== request()->user()->id) {
            return response()->json([
                'message' => 'This User is not authorized to edit the job.'
            ], 422);
        }
        $job->update($request->validateWithUser());
        return response()->json([
            'job' => new JobResource($job),
            'massage' => 'Job created successfully',
            'status' => true]);
    }

    public function destroy(Job $job): JsonResponse
    {
        $job->delete();
        return response()->json([
            'message' => 'Job deleted successfully',
            'status' => true,
        ]);
    }
}

<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\v1\StoreJobRequest;
use App\Http\Requests\v1\UpdateJobRequest;
use App\Http\Resources\v1\JobCollection;
use App\Http\Resources\v1\JobResource;
use App\Models\Job;
use App\service\v1\JobQuery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request): JobCollection
    {
        $filter = new JobQuery();
        $filterItems = $filter->transform($request);
        $getApplicants = $request->get('getApplicants');

        $jobs = Job::query();

        // Always apply where filters
        if (!empty($filterItems)) {
            $jobs->where($filterItems);
        }

        // Always eager load employer
        $jobs->with('employer');

        // If applicants requested, eager load and count them
        if ($getApplicants === 'true' || $request->has('numberOfApplicants')) {
            $jobs->with('applicants')->withCount('applicants');
        }

        // Apply HAVING only after withCount
        if ($request->has('numberOfApplicants')) {
            $filter = $request->get('numberOfApplicants');

            if (isset($filter['gt'])) {
                $jobs->having('applicants_count', '>', $filter['gt']);
            }

            if (isset($filter['lt'])) {
                $jobs->having('applicants_count', '<', $filter['lt']);
            }

            // optional: >=, <=, eq
        }

        return new JobCollection(
            $jobs->paginate()->appends($request->query())
        );
    }


    public function show(Job $job): JsonResponse
    {
        return response()->json([
            'job' => new JobResource($job),
            'status' => 'success',
            'message' => 'Retrieved Job Successfully'
        ]);
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
            'status' => 'success'
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
            'status' => 'success',
        ]);
    }
}

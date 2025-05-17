<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\JobCollection;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function index(): JobCollection
    {
        $jobs = Job::with('employer')->latest()->paginate(3);
        return new JobCollection($jobs);


    }

    public function store(): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'title' => ['required', 'min:3'],
            'salary' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => false,
                'massage' => 'Validation failed'
            ], 422);
        }
        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => request()->user()->id,
        ]);
        return response()->json([
            'job' => $job,
            'massage' => 'Job created successfully',
            'status' => true
        ], 201);

    }

    public function show(Job $job)
    {
        return response()->json([
            'job' => $job,
            'massage' => 'Job Found Successfully'
        ]);

    }

    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        $validator = Validator::make(request()->all(), [
            'title' => ['required', 'min:3'],
            'salary' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => false,
                'massage' => 'Validation failed'
            ], 422);
        }
        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => request()->user()->id,
        ]);
        return response()->json([
            'job' => $job,
            'massage' => 'Job created successfully',
            'status' => true
        ], 201);
        return redirect(' / jobs / ' . $job->id);
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect(' / jobs');
    }
}

<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\v1\StoreApplicantRequest;
use App\Http\Resources\v1\ApplicantCollection;
use App\Http\Resources\v1\ApplicantResource;
use App\Models\Applicant;

class ApplicantController extends Controller
{
    public function index()
    {
        return response()->json([
            'applicants' => new ApplicantCollection(Applicant::all()),
            'status' => 'success',
            'message' => 'Retrieved Applicants Successfully'
        ]);
    }

    public function show(Applicant $applicant)
    {
        return response()->json([
            'applicant' => new ApplicantResource($applicant),
            'status' => 'success',
            'message' => 'Retrieved Applicant Successfully'
        ]);
    }

    public function store(StoreApplicantRequest $request)
    {
        $applicant = Applicant::create($request->validated());

        return response()->json([
            'applicant' => new ApplicantResource($applicant),
            'status' => 'success',
            'message' => 'Applicant Created Successfully'
        ], 201);
    }
}

<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'salary' => $this->salary,
            'employer_id' => $this->employer_id,
            'numberOfApplicants' => $this->when(isset($this->applicants_count), $this->applicants_count),

            'applicants' => ApplicantResource::collection($this->whenLoaded('applicants')),
            //'applications' => ApplicationResource::collection($this->whenLoaded('applications'))

        ];
    }
}

<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('PUT')) {
            return [
                'title' => ['required', 'min:3'],
                'salary' => ['required', 'numeric'],
            ];
        }

        return [
            'title' => ['sometimes', 'required', 'min:3'],
            'salary' => ['sometimes', 'required', 'numeric'],
        ];
    }

    public function validateWithUser()
    {
        return array_merge($this->validated(), [
            'employer_id' => auth()->id()
        ]);
    }
}

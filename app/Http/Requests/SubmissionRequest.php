<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'email'],
            'languages' => ['required', 'array'],
            'languages.*' => ['string'],
            'max_marks' => ['required', 'numeric', 'min:1'],
            'marks_obtained' => ['required', 'numeric', 'min:0', 'lte:max_marks'],
            'description' => ['nullable', 'string'],
            'issues' => ['nullable', 'array'],
            'issues.*' => ['string', 'max:255'],
            'images' => ['nullable', 'array', 'max:5'], // Optional, max 5 images
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'], // Max 5MB per image
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'Only alphabetic characters and spaces are allowed.',
            'marks_obtained.lte' => 'The obtained marks must not exceed the total marks.',
        ];
    }
}

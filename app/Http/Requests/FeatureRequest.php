<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'flag'         =>
                'string',
                'unique:features,flag',
                'regex:/^[A-Z0-9_]+$/',
            'status'      => 'required|string|in:active,inactive',
            'user_group'  => 'nullable|array',
            'user_group.*'=> 'integer|exists:roles,id',
            'schedule_from'=> 'nullable|date',
            'schedule_to'  => 'nullable|date|after:schedule_from',
        ];
    }

     protected function prepareForValidation()
    {
        if ($this->has('key')) {
            $this->merge([
                'flag' => strtoupper(str_replace(' ', '_', $this->key)),
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'flag.regex' => 'The flag may only contain uppercase letters, numbers, and underscores (e.g., PHOTO_UPLOAD).',
        ];
    }
}

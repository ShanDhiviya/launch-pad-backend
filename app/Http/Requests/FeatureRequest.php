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
            'key'         =>
                'string',
                'unique:features,key',
                'regex:/^[A-Z0-9_]+$/',
            'status'      => 'required|boolean',
            'user_group'  => 'nullable|array',
            'user_group.*'=> 'integer|exists:roles,id'
        ];
    }

     protected function prepareForValidation()
    {
        if ($this->has('key')) {
            $this->merge([
                'key' => strtoupper(str_replace(' ', '_', $this->key)),
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'key.regex' => 'The key may only contain uppercase letters, numbers, and underscores (e.g., PHOTO_UPLOAD).',
        ];
    }
}

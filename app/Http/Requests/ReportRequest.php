<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'description' => 'string|max:255',
            'location' => 'string|max:100',
            'date_of_incident' => 'required|date',
            'time_of_incident' => 'date_format:H:i',
            'damage_severity' => 'string|max:100',
            'estimated_cost' => 'numeric',
            'photos' => 'array',
            'status' => 'string|max:100',
        ];
    }
}

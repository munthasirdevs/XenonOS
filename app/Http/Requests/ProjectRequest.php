<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $projectId = $this->route('project')?->id;
        
        return [
            'client_id' => 'required|exists:clients,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:active,completed,paused,cancelled',
            'priority' => 'sometimes|in:low,medium,high,urgent',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'budget' => 'nullable|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'client_id.required' => 'Client is required',
            'client_id.exists' => 'Selected client does not exist',
            'name.required' => 'Project name is required',
            'end_date.after_or_equal' => 'End date must be after or equal to start date',
        ];
    }
}
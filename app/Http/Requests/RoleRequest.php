<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $roleId = $this->route('role')?->id;
        
        return [
            'name' => 'required|string|max:50',
            'slug' => 'required|string|max:50|unique:roles,slug,' . $roleId,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Role name is required',
            'slug.required' => 'Role slug is required',
            'slug.unique' => 'This slug is already taken',
        ];
    }
}
<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CourseCategoryStoreRequest extends FormRequest
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
        return [
            'image' => 'required|image|max:600',
            'name' => 'required|string|max:255|unique:course_categories,name',
            'icon_name' => 'required|string|max:40',
            'show_at_trending' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ];
    }
}

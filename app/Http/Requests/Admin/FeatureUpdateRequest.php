<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FeatureUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image_one' => 'nullable|image|max:600',
            'title_one' => 'nullable|string|max:255',
            'subtitle_one' => 'nullable|string|max:255',

            'image_two' => 'nullable|image|max:600',
            'title_two' => 'nullable|string|max:255',
            'subtitle_two' => 'nullable|string|max:255',

            'image_three' => 'nullable|image|max:600',
            'title_three' => 'nullable|string|max:255',
            'subtitle_three' => 'nullable|string|max:255',
        ];
    }
}

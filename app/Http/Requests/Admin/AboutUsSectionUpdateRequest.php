<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsSectionUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // OBRÁZKY JSME ODSTRANILI - budeme je řešit v Controlleru
            // 'image' => 'nullable|image|max:600',
            // 'learner_image' => 'nullable|image|max:600',
            // 'video_image' => 'nullable|image|max:600',
            'rounded_text' => 'nullable|string|max:255',
            'learner_count' => 'nullable|string|max:255',
            'learner_count_text' => 'nullable|string|max:255',
            'about_title' => 'nullable|string|max:255',
            'about_description' => 'nullable|string|max:2000',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'video_url' => 'nullable|string|max:255',
        ];
    }
}

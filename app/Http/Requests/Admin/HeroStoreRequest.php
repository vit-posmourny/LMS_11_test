<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HeroStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'label' => 'required|max:255|string',
            'title' => 'required|max:255|string',
            'subtitle' => 'required|max:255|string',
            'button_text' => 'nullable|max:255|string',
            'button_url' => 'nullable|max:255|string',
            'video_button_text' => 'nullable|max:255|string',
            'video_button_url' => 'nullable|max:255|string',
            'banner_item_title' => 'nullable|max:255|string',
            'banner_item_subtitle' => 'nullable|max:255|string',
            'hero_image' => 'required|image|max:600',
            'rounded_text' => 'nullable|max:255|string',
        ];
    }
}

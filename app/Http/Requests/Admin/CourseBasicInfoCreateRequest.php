<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CourseBasicInfoCreateRequest extends FormRequest
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
            "title" => "required",
            'seo_description' => 'nullable|max:255|string',
            'demo_video_storage' => 'nullable|in:upload,youtube,vimeo,external-link|string',
            'price' => 'numeric',
            'discount_price' => 'nullable|numeric',
            'description' => 'required',
            'thumbnail' => 'required|image|max:600',
            'video_path' => 'nullable',
        ];
    }
}

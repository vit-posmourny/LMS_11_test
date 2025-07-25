<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            "name" => "required|max:255|string",
            "headline" => "nullable|max:255|string",
            "email" => "required|max:255|email|unique:users,email,".auth()->user()->id,
            "gender" => "nullable|in:male,female",
            "bio" => "nullable|max:255|string",
            "avatar" => "nullable|image|max:600",
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            'name' => "required|max:191|unique:experiences,name,{$this->id},id,deleted_at,NULL",
            'cover' => 'required|image|mimes:jpg,png,jpeg,gif,webp|max:4096|dimensions:max_width=4000,max_height=4000',
        ];
    }
}

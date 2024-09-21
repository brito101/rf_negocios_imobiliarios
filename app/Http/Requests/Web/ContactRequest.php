<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'property_id' => 'nullable|exists:properties,id',
            'name' => 'required|min:3|max:191',
            'cell' => 'nullable|min:8|max:25',
            'email' => 'required|email',
            'message' => 'required|min:10|max:1000',
            'instagram' => 'nullable|max:191',
        ];
    }

    public function messages(): array
    {
        return [
            'property_id' => 'Imóvel inválido',
        ];
    }
}

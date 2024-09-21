<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AgencyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'alias_name' => 'required',
            'social_name' => 'nullable|min:1|max:191',
            'email' => 'nullable|email|min:1|max:191',
            'phone' => 'nullable|min:1|max:191',
            'document_company' => 'nullable|min:1|max:191',
            'document_company_secondary' => 'nullable|min:1|max:191',
            'zipcode' => 'nullable|min:8|max:10',
            'street' => 'nullable|min:1|max:191',
            'number' => 'nullable|min:1|max:191',
            'neighborhood' => 'nullable|min:1|max:191',
            'state' => 'nullable|min:1|max:2',
            'city' => 'nullable|min:1|max:191',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'required|min:2|max:100',
            'document_person' => "nullable|min:11|max:20|unique:clients,document_person,{$this->id},id,deleted_at,NULL",
            'document_registry' => 'nullable|min:11|max:20',
            'email' => 'nullable|min:8|max:100|email',
            'telephone' => 'nullable|min:8|max:25',
            'cell' => 'nullable|max:25',
            'zipcode' => 'nullable|min:8|max:13',
            'street' => 'nullable|min:3|max:100',
            'number' => 'nullable|min:1|max:100',
            'complement' => 'nullable|max:100',
            'neighborhood' => 'nullable|max:100',
            'state' => 'nullable|min:2|max:2',
            'city' => 'nullable|min:2|max:100',
            'company' => 'nullable|max:65000',
            'observations' => 'nullable|max:4000000000',
            'agency_id' => 'nullable|exists:agencies,id',
            'meeting' => 'nullable|date_format:Y-m-d',
            'instagram' => 'nullable|max:191',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'sale_price' => str_replace(',', '.', str_replace('.', '', str_replace('R$ ', '', $this->sale_price))),
            'rent_price' => str_replace(',', '.', str_replace('.', '', str_replace('R$ ', '', $this->rent_price))),
            'condominium' => str_replace(',', '.', str_replace('.', '', str_replace('R$ ', '', $this->condominium))),
            'differentials_resume' => strip_tags($this->differentials_resume, '<p>'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:191',
            'headline' => 'required|max:191',
            'cover' => 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:4096|dimensions:max_width=860,min_height=490,max_width=4000,max_height=4000',
            'experience_id' => 'required|exists:experiences,id',
            'type_id' => 'required|exists:types,id',
            'goal' => 'required|in:Venda,Locação,Venda ou Locação',
            'status' => 'required|in:Disponível,Indisponível',
            'owner' => 'nullable||exists:clients,id',
            'client_id' => 'nullable||exists:clients,id',
            'sale_price' => 'nullable||numeric|between:0,999999999.999',
            'rent_price' => 'nullable||numeric|between:0,999999999.999',
            'condominium' => 'nullable||numeric|between:0,999999999.999',
            'description' => 'required|max:400000000',
            'video' => 'nullable|url|max:150',
            'rooms' => 'nullable|integer|max:100',
            'bedrooms' => 'nullable|integer|max:100',
            'suites' => 'nullable|integer|max:100',
            'bathrooms' => 'nullable|integer|max:100',
            'garage' => 'nullable|integer|max:100',
            'garage_covered' => 'nullable|integer|max:100',
            'area_total' => 'nullable|numeric|min:0|max:999999',
            'area_util' => 'nullable|numeric|min:0|max:999999',
            'zipcode' => 'nullable|max:191',
            'street' => 'nullable|max:191',
            'number' => 'nullable|max:191',
            'complement' => 'nullable|max:191',
            'neighborhood' => 'nullable|max:191',
            'state' => 'nullable|max:191',
            'city' => 'nullable|max:191',
            'agency_id' => 'nullable|exists:agencies,id',
            'header_pixel' => 'nullable|max:65535',
            'body_pixel' => 'nullable|max:65535',
            'template' => 'nullable|in:default',
            'differentials_resume' => 'nullable|max:65000',
        ];
    }
}

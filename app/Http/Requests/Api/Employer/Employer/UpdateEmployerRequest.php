<?php

namespace App\Http\Requests\Api\Employer\Employer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'nullable',
            'email' => ['nullable','email', Rule::unique('users')->ignore($this->user()->id)],
            'location.latitude' => 'nullable|numeric|required_with:location.longitude',
            'location.longitude' => 'nullable|numeric|required_with:location.latitude',
            'attributes.bio' => 'nullable|string',
            'attributes.office_photo' => 'nullable|image',
            'attributes.legal_document' => 'nullable|file',
        ];
    }
}

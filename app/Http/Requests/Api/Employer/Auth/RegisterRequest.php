<?php
/**
 * User: amir
 * Date: 1/30/20
 * Time: 11:47 AM
 */

namespace App\Http\Requests\Api\Employer\Auth;


use Illuminate\Validation\Rule;

class RegisterRequest extends \App\Http\Requests\Api\Auth\RegisterRequest
{
    protected function attributesRules()
    {
        return [
            'company_name' => ['required', 'string', 'min:3', 'max:75'],
            'attributes.commercial_business_industry' => ['min:3', 'max:75'],
            'attributes.bio' => ['required', 'string'],
            'attributes.office_photo' => ['nullable', 'image'],
            'attributes.office_photo_base64' => ['nullable', 'base64_image'],
            'attributes.legal_document' => ['nullable', 'file'],
            'attributes.legal_document_base64' => ['nullable', 'base64_file'],
        ];
    }
}

<?php

namespace App\Http\Requests\Frontend\Contact;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SendContactRequest.
 */
class SendContactRequest extends FormRequest
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
            'subject' => 'required|string',
            'body' => 'required|string',
            'email' => 'required|email',
            'category_id' => 'exists:contact_categories,id'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ];
    }
}

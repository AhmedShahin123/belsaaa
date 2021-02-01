<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class RegisterRequest.
 */
abstract class RegisterRequest extends \App\Http\Requests\Frontend\Auth\RegisterRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        unset($rules['g-recaptcha-response']);
        // Remove `confirmed` rule from password rule
        if (isset($rules['password'])) {
            $rules['password'] = array_filter($rules['password'], function ($rule) {
                if (!is_string($rule) || $rule !== 'confirmed') {
                    return true;
                }

                return false;
            });
        };

        $rules['photo'] = ['image', 'nullable'];
        $rules['latitude'] = ['required', 'numeric'];
        $rules['longitude' ] = ['required', 'numeric'];

        $rules = array_merge($rules, $this->attributesRules());

        return $rules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        $messages = parent::messages();
        unset($messages['g-recaptcha-response.required_if']);
        $messages['email.unique'] = 'duplicated_email';

        return $messages;
    }

    abstract protected function attributesRules();
}

<?php
/**
 * User: amir
 * Date: 1/30/20
 * Time: 11:48 AM
 */

namespace App\Http\Requests\Api\Tasker\Auth;


use Illuminate\Validation\Rule;

class RegisterRequest extends \App\Http\Requests\Api\Auth\RegisterRequest
{
    protected function attributesRules()
    {
        return [
            'first_name' => ['required', 'string', 'min:3', 'max:20'],
            'last_name' => ['required', 'string', 'min:3', 'max:20'],
            'attributes.national_number' => ['required', 'string', 'numeric', 'digits:10', Rule::unique('tasker_attributes', 'national_number')],
            'attributes.gender' => ['required', Rule::in(['female', 'male'])],
            'attributes.birth_date' => ['required', 'date_format:Y-m-d'],
            'attributes.bio' => ['nullable', 'string'],
            'attributes.hour_rate' => ['nullable', 'integer'],
        ];
    }
}

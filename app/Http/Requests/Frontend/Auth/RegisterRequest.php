<?php

namespace App\Http\Requests\Frontend\Auth;

use App\Helpers\General\PhoneNumberHelper;
use App\Repositories\Auth\UserRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class RegisterRequest.
 */
class RegisterRequest extends FormRequest
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
            'cellphone' => ['required', 'phone:SA,IR', function ($attribute, $value, $fail)
            {
                /** @var UserRepository $userRepository */
                $userRepository = app(UserRepository::class);

                $user = $userRepository->findByCellphone($value);

                if ($user) {
                    $fail('duplicated_cellphone');
                }
            }],
            'email' => ['required', 'string', 'email', Rule::unique('users'), 'min:10', 'max:75'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'g-recaptcha-response' => ['required_if:captcha_status,true', 'captcha'],
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

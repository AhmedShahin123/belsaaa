<?php

namespace App\Http\Requests\Api\Auth;

use App\Models\Auth\User;
use App\Repositories\Auth\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

abstract class LoginRequest extends FormRequest
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
            'username' => [
                'required',
                function($attribute, $value, $fail) {
                    /** @var UserRepository $userRepository */
                    $userRepository = app(UserRepository::class);
                    $user = $userRepository->findByCredentials($value);
                    if (is_null($user) || $user->user_type != $this->getUserType()) {
                        $fail('Invalid username or password');

                        return;
                    }
                    $password = request('password');

                    if ($password && !$userRepository->verifyPassword($user, $password)) {
                        $fail('Invalid username or password');
                    }
                },
            ],
            'password' => [
                'required',
                'string',
            ]
        ];
    }

    abstract public function getUserType(): string;
}

<?php

namespace App\Http\Requests\Api\Employer\Auth;

use App\Repositories\Auth\UserRepository;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    /** @var UserRepository $userRepository */
                    $userRepository = app(UserRepository::class);
                    $user = $this->user();

                    if (!$userRepository->verifyPassword($user, $value)) {
                        $fail('Invalid password');
                    }
                },
            ],
            'new_password' => [
                'required',
                'string',
            ],
        ];
    }
}

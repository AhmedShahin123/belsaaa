<?php

namespace App\Http\Requests\Api\Auth;

use App\Models\Auth\User;
use App\Repositories\Auth\UserRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

abstract class ForgetPasswordRequest extends FormRequest
{
    /**
     * @var User
     */
    public $validatedUser;

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
            'cellphone' => [
                'required',
                'phone:SA,IR',
                function($attribute, $value, $fail) {
                    /** @var UserRepository $userRepository */
                    $userRepository = app(UserRepository::class);
                    $this->validatedUser = $userRepository->findByCellphone($value);

                    if (!$this->validatedUser || $this->validatedUser->user_type !== $this->getUserType()) {
                        $fail('invalid_cellphone');
                    }
                }
            ],
        ];
    }

    abstract public function getUserType();
}

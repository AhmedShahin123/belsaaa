<?php

namespace App\Http\Requests\Backend\Employer;

use App\Repositories\Auth\UserRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateEmployerRequest.
 */
class UpdateEmployerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'active' => ['required', 'boolean'],
            'email' => ['required', 'email', "unique:users,email,".optional($this->employer)->id, 'min:10', 'max:75'],
            'company_name' => ['required', 'min:3', 'max:75'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'cellphone' => ['required', 'phone:SA,IR', function ($attribute, $value, $fail)
            {
                if ($value === optional($this->employer)->cellphone) {
                    return;
                }
                /** @var UserRepository $userRepository */
                $userRepository = app(UserRepository::class);

                $user = $userRepository->findByCellphone($value);

                if ($user) {
                    $fail('duplicated_cellphone');
                }
            }],
            'password' => ['nullable', 'confirmed'],
            'user_attributes' => [
                'commercial_email' => ['required', 'email'],
                'commercial_business_industry' => ['required', 'min:3', 'max:75'],
                'office_photo' => ['required', 'image'],
            ],
        ];
    }
}

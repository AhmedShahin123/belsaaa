<?php

namespace App\Http\Requests\Backend\Tasker;

use App\Repositories\Auth\UserRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateTaskerRequest.
 */
class UpdateTaskerRequest extends FormRequest
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
            'email' => ['required', 'email', "unique:users,email,".optional($this->tasker)->id, 'min:10', 'max:75'],
            'first_name' => ['required', 'min:3', 'max:20'],
            'last_name' => ['required', 'min:3', 'max:20'],
            'cellphone' => ['required', 'phone:SA,IR', function ($attribute, $value, $fail)
            {
                if ($value === optional($this->tasker)->cellphone) {
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

            'user_attributes.address' => ['required'],
            'user_attributes.national_number' => ['required', 'numeric', function ($attribute, $value, $fail) {
                if (strlen($value) !== 10) {
                    $fail('National number must be 10 digits');
                }
            }],
            'user_attributes.birth_date' => ['required', 'date_format:Y-m-d'],
            'user_attributes.bio' => ['required'],
            'user_attributes.gender' => ['required', Rule::in(['male', 'female'])],
        ];
    }
}

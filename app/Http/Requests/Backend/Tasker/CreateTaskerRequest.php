<?php

namespace App\Http\Requests\Backend\Tasker;

use App\Repositories\Auth\UserRepository;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateTaskerRequest.
 */
class CreateTaskerRequest extends UpdateTaskerRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['password'] = ['required', 'confirmed'];

        return $rules;
    }
}

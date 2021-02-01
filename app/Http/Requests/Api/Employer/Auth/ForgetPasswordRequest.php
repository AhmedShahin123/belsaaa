<?php

namespace App\Http\Requests\Api\Employer\Auth;

use App\Models\Auth\User;
use App\Repositories\Auth\UserRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ForgetPasswordRequest extends \App\Http\Requests\Api\Auth\ForgetPasswordRequest
{
    public function getUserType()
    {
        return 'employer';
    }
}

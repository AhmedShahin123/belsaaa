<?php

namespace App\Http\Requests\Api\Tasker\Auth;

use App\Models\Auth\User;
use App\Repositories\Auth\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

class LoginRequest extends \App\Http\Requests\Api\Auth\LoginRequest
{
    public function getUserType(): string
    {
        return 'tasker';
    }
}

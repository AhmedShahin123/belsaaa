<?php
/**
 * User: amir
 * Date: 1/30/20
 * Time: 2:07 PM
 */

namespace App\Http\Controllers\Api\Employer\Auth;


use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Employer\Auth\ForgetPasswordRequest;
use App\Repositories\Auth\UserRepository;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    public function __invoke(ForgetPasswordRequest $request, UserRepository $userRepository)
    {
        return $request->validatedUser->requestForgetPassword();
    }
}

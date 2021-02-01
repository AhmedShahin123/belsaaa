<?php
/**
 * User: amir
 * Date: 1/30/20
 * Time: 2:07 PM
 */

namespace App\Http\Controllers\Api\Tasker\Auth;


use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Auth\RecoverForgottenPasswordRequest;
use App\Repositories\Auth\UserRepository;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Lcobucci\JWT\Parser;

class RecoverForgottenPasswordController extends Controller
{
    /**
     * @param RecoverForgottenPasswordRequest $request
     * @param UserRepository $userRepository
     *
     * @return mixed|void
     */
    public function __invoke(RecoverForgottenPasswordRequest $request, UserRepository $userRepository)
    {
        $userRepository->changePassword($request->user(), $request->password);

        return $request->user();
    }
}

<?php
/**
 * User: amir
 * Date: 1/30/20
 * Time: 2:07 PM
 */

namespace App\Http\Controllers\Api\Tasker\Auth;


use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Auth\VerifyForgetPasswordRequest;
use App\Repositories\Auth\UserRepository;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Lcobucci\JWT\Parser;

class VerifyForgetPasswordController extends Controller
{
    /**
     * @param VerifyForgetPasswordRequest $request
     * @param UserRepository $userRepository
     *
     * @return mixed|void
     */
    public function __invoke(VerifyForgetPasswordRequest $request, UserRepository $userRepository)
    {
        $jwt = trim((string) preg_replace('/^(?:\s+)?Bearer\s/', '', $request->header('Authorization')));
        $token = (new Parser())->parse($jwt);

        $response = null;

        \Validator::make(
            ['code' => $request->code],
            [
                'code' => function($attribute, $value, $fail) use ($token, $request, &$response) {
                    $response = $request->user()->verifyForgetPassword($request->code, $token->getClaim('hash'));

                    if (!$response instanceof JsonResource) {
                        $fail('invalid_code');
                    }
                }
            ]
        )->validate();

        return $response;
    }
}

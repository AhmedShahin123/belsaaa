<?php

namespace App\Http\Controllers\Api\Employer\Auth;

use App\Events\Frontend\Auth\UserRegistered;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Employer\Auth\RegisterRequest;
use App\Http\Resources\Auth\PersonalAccessTokenResult;
use App\Repositories\Auth\UserRepository;

class RegisterController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(RegisterRequest $request)
    {
        $user = $this->userRepository->create('employer', $request->only(
            'company_name', 'email', 'password', 'cellphone', 'latitude', 'longitude', 'attributes'
        ));

        event(new UserRegistered($user));

        $token = PersonalAccessTokenResult::make($user->createToken('api', ['employer']));

        return [
            "data" => [
                'access_token' => $token->resource->accessToken,
                'user' => $user->load('user_attributes'),
            ]
        ];
    }
}

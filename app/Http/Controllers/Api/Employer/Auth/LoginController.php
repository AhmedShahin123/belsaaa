<?php

namespace App\Http\Controllers\Api\Employer\Auth;

use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserRegistered;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Employer\Auth\LoginRequest;
use App\Http\Requests\Api\Employer\Auth\RegisterRequest;
use App\Http\Resources\Auth\PersonalAccessTokenResult;
use App\Repositories\Auth\UserRepository;

class LoginController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(LoginRequest $request)
    {
        $user = $this->userRepository->findByCredentials($request->username);

        event(new UserLoggedIn($user));

        $token = PersonalAccessTokenResult::make($user->createToken('api', ['employer']));

        return [
            "data" => [
                'access_token' => $token->resource->accessToken,
                'user' => $user->load('user_attributes'),
            ]
        ];
    }
}

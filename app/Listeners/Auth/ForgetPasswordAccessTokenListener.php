<?php
/**
 * User: amir
 * Date: 4/22/20
 * Time: 3:14 AM
 */

namespace App\Listeners\Auth;


use App\Events\Auth\BuildingJWT;
use App\Models\Auth\User;
use App\Repositories\Auth\UserRepository;
use Carbon\Carbon;
use Laravel\Passport\Bridge\Scope;

class ForgetPasswordAccessTokenListener
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function verifyScope(BuildingJWT $event)
    {
        $scopeIdentifiers = array_map(function (Scope $scope) {
            return $scope->getIdentifier();
        }, $event->accessToken->getScopes());

        if (
            in_array('tasker_forget_password_verify', $scopeIdentifiers) ||
            in_array('employer_forget_password_verify', $scopeIdentifiers)
        ) {
            /** @var User $user */
            $user = $this->userRepository->getById($event->accessToken->getUserIdentifier());
            $hash = $user->generateForgetPasswordCode();

            $event->builder->withClaim('hash', $hash);
            $event->builder->setExpiration(Carbon::now()->addMinutes(5)->getTimestamp());
        }
    }

    public function getHash($user)
    {
        return $user->generateForgetPasswordCode();
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            BuildingJWT::class,
            'App\Listeners\Auth\ForgetPasswordAccessTokenListener@verifyScope'
        );
    }
}

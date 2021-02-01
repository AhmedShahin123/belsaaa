<?php
/**
 * User: amir
 * Date: 3/9/20
 * Time: 5:53 PM
 */

namespace App\Http\Controllers\Api\Tasker\Auth;


use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Tasker\Auth\ChangePasswordRequest;
use App\Repositories\Auth\UserRepository;

class ChangePasswordController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(ChangePasswordRequest $request)
    {
        $this->userRepository->changePassword($request->user(), $request->new_password);

        return response()->noContent();
    }
}

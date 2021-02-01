<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserPasswordRequest;
use App\Models\Auth\User;
use App\Repositories\Backend\Auth\UserRepository;
use App\Rules\Auth\UnusedPassword;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class UserPasswordController.
 */
class UserPasswordController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     */
    public function edit(ManageUserRequest $request, User $user)
    {
        if ($request->isMethod('POST')) {
            $validator = \Validator::make($request->only(['password', 'password_confirmation']), [
                'password' => 'confirmed',
            ]);

            $this->userRepository->updatePassword($user, $validator->validate());

            return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.updated_password'));
        }

        return view('backend.auth.user.change-password')
            ->withUser($user);
    }

    /**
     * @param UpdateUserPasswordRequest $request
     * @param User                      $user
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function update(UpdateUserPasswordRequest $request, User $user)
    {
        $this->userRepository->updatePassword($user, $request->only('password'));

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.updated_password'));
    }
}

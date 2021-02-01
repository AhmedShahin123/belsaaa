<?php
/**
 * User: amir
 * Date: 4/21/20
 * Time: 6:37 PM
 */

namespace App\Http\Controllers\Api\Tasker\Tasker;


use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Tasker\Tasker\UpdatePhotoRequest;
use App\Repositories\Auth\UserRepository;

class UpdatePhotoController extends Controller
{
    public function __invoke(UpdatePhotoRequest $request, UserRepository $userRepository)
    {
        return $userRepository->updateTaskerPhoto($this->user(), $request->photo());
    }
}

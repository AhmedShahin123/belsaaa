<?php

namespace App\Http\Controllers\Api\Tasker\Tasker;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Tasker\Tasker\UpdateTaskerRequest;
use App\Repositories\Auth\UserRepository;
use Illuminate\Http\Request;

class UpdateTaskerController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UpdateTaskerRequest $request)
    {
        $data = $request->getTaskerData();
        $this->userRepository->updateTasker($this->user(), $data, $request->working_days);

        return $this->user();
    }
}

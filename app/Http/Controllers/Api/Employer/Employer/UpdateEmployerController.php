<?php

namespace App\Http\Controllers\Api\Employer\Employer;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Employer\Employer\UpdateEmployerRequest;
use App\Repositories\Auth\UserRepository;

class UpdateEmployerController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UpdateEmployerRequest $request)
    {
        $this->userRepository->updateEmployer($this->user(), $request->validated());

        return $this->user();
    }
}

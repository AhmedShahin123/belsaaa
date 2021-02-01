<?php
/**
 * User: amir
 * Date: 2/17/20
 * Time: 1:26 AM
 */

namespace App\TaskerLocator;


use App\Models\Task;
use App\Repositories\Auth\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class ContinuedTaskerLocator implements TaskerLocatorInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function support(Task $task): bool
    {
        return $task->task_type == Task::TASK_TYPE_CONTINUED;
    }

    public function locate(Task $task): Collection
    {
        return $this->userRepository->forOneTimeTaskNew($task)->get();
    }
}

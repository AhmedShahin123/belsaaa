<?php
/**
 * User: amir
 * Date: 2/26/20
 * Time: 10:27 PM
 */

namespace App\Http\Controllers\Api\Tasker\Task;


use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Tasker\Task\CancelTaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepository;

class CancelTaskController extends Controller
{
    public function __invoke(Task $task, CancelTaskRequest $request, TaskRepository $taskRepository)
    {
        $taskRepository->cancel($task, $this->user());

        return response()->noContent();
    }
}

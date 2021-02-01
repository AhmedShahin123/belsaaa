<?php
/**
 * User: amir
 * Date: 2/26/20
 * Time: 10:27 PM
 */

namespace App\Http\Controllers\Api\Employer\Task;


use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Employer\Task\CancelTaskRequest;
use App\Http\Requests\Api\Employer\Task\StartTaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepository;

class StartTaskController extends Controller
{
    public function __invoke(Task $task, StartTaskRequest $request, TaskRepository $taskRepository)
    {
        $taskRepository->start($task);

        return response()->noContent();
    }
}

<?php

namespace App\Http\Controllers\Api\Tasker\Task;

use App\Http\Controllers\Api\Controller;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

class ShowTaskController extends Controller
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function __invoke($taskId)
    {
        $task = $this->taskRepository->getForTaskerSingle($this->user(), $taskId);

        if (is_null($task)) {
            abort(404);
        }

        return $task->load([
            'assignment_request_taskers',
            'payments',
            'payments.credit_card',
        ]);
    }
}

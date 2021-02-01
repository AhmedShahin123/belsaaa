<?php

namespace App\Http\Controllers\Api\Employer\Task;

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
        $task = $this->taskRepository->getForEmployerSingle($this->user(), $taskId);

        if (is_null($task)) {
            abort(404);
        }

        return $task->load([
            'assignment_request_taskers',
            'tasker_accepted_requests',
            'tasker_accepted_requests.tasker',
            'employer_accepted_requests',
            'employer_accepted_requests.tasker',
            'invoices',
            'invoices.tasker',
            'payments',
            'payments.credit_card',
        ]);
    }
}

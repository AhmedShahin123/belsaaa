<?php

namespace App\Http\Controllers\Api\Employer\Task;

use App\Factories\TaskFactory;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Employer\Task\CreateTaskRequest;
use App\Repositories\TaskRepository;

class CreateTaskController extends Controller
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * @var TaskFactory
     */
    private $taskFactory;

    public function __construct(
        TaskRepository $taskRepository,
        TaskFactory $taskFactory)
    {
        $this->taskRepository = $taskRepository;
        $this->taskFactory = $taskFactory;
    }

    public function __invoke(CreateTaskRequest $request)
    {
        $data = $request->only([
            'title',
            'description',
            'latitude',
            'longitude',
            'hour_rate',
            'required_tasker_number',
            'required_tasker_gender',
            'task_type'
        ]);

        return $this->taskRepository->create($data, $request->taskAttributes(), $this->user());
    }
}

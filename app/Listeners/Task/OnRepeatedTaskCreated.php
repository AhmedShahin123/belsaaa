<?php

namespace App\Listeners\Task;

use App\Events\TaskCreated as TaskCreatedEvent;
use App\Repositories\TaskRepository;

class OnRepeatedTaskCreated
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * Create the event listener.
     *
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Handle the event.
     *
     * @param  TaskCreatedEvent  $event
     *
     * @return void
     */
    public function handle(TaskCreatedEvent $event)
    {
        $task = $event->getTask();

        if ($task->task_type !== 'repeated') {
            return;
        }

        $this->taskRepository->createRepeatedChildrenTasks($task);
    }
}

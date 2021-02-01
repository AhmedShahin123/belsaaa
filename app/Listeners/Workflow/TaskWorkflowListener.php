<?php

namespace App\Listeners\Workflow;


use App\Factories\InvoiceFactory;
use App\Models\AssignmentRequestTasker;
use App\Models\Task;
use App\Notifications\EmployerTaskCanceled;
use App\Notifications\EmployerTaskFinished;
use App\Notifications\EmployerTaskStarted;
use App\Notifications\TaskerTaskCanceled;
use App\Notifications\TaskSentToAdmin;
use App\Repositories\AssignmentRequestTaskerRepository;
use App\Repositories\Auth\UserRepository;
use App\Repositories\TaskRepository;
use Symfony\Component\Workflow\Event\CompletedEvent;
use Symfony\Component\Workflow\Event\GuardEvent;

class TaskWorkflowListener
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * @var InvoiceFactory
     */
    private $invoiceFactory;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var AssignmentRequestTaskerRepository
     */
    private $assignmentRequestTaskerRepository;

    public function __construct(
        TaskRepository $taskRepository,
        InvoiceFactory $invoiceFactory,
        UserRepository $userRepository,
        AssignmentRequestTaskerRepository $assignmentRequestTaskerRepository
    ) {
        $this->taskRepository = $taskRepository;
        $this->invoiceFactory = $invoiceFactory;
        $this->userRepository = $userRepository;
        $this->assignmentRequestTaskerRepository = $assignmentRequestTaskerRepository;
    }

    public function afterStartSending(CompletedEvent $event)
    {
        /** @var Task $task */
        $task = $event->getSubject();

        $this->taskRepository->sendAssignmentRequestTasker($task);
    }

    public function afterCanceled(CompletedEvent $event)
    {
        /** @var Task $task */
        $task = $event->getSubject();

        foreach ($task->participant_assignment_request_taskers as $assignment_request_taskers) {
            if ($task->canceled_by->id !== $assignment_request_taskers->tasker_id) {
                $assignment_request_taskers->tasker->notify(new TaskerTaskCanceled($assignment_request_taskers));
            }
        }

        if ($task->canceled_by->user_type !== 'employer') {
            $task->employer->notify(new EmployerTaskCanceled($task));
        }
    }

    public function afterFinished(CompletedEvent $event)
    {
        /** @var Task $task */
        $task = $event->getSubject();

        $task->employer_accepted_requests()
            ->with('tasker')
            ->get()
            ->each(function (AssignmentRequestTasker $assignmentRequestTasker) use ($task) {
                $this->invoiceFactory->create($task, $assignmentRequestTasker->tasker);
            });

        $task->employer->notify(new EmployerTaskFinished($task));
    }

    public function afterStarted(CompletedEvent $event)
    {
        /** @var Task $task */
        $task = $event->getSubject();

        $task->employer->notify(new EmployerTaskStarted($task));
    }

    public function afterSentToAdmin(CompletedEvent $event)
    {
        /** @var Task $task */
        $task = $event->getSubject();

        $notification = new TaskSentToAdmin($task);
        \Notification::send($this->userRepository->getAdmins(), $notification);
        $task->employer->notify($notification);
    }

    public function afterAccept(CompletedEvent $event)
    {
        /** @var Task $task */
        $task = $event->getSubject();

        /** @var AssignmentRequestTasker $assignmentRequestTasker */
        foreach ($task->pending_requests as $assignmentRequestTasker) {
            $this->assignmentRequestTaskerRepository->taskerTimeout($assignmentRequestTasker);
        }

        /** @var AssignmentRequestTasker $assignmentRequestTasker */
        foreach ($task->tasker_accepted_requests as $assignmentRequestTasker) {
            $this->assignmentRequestTaskerRepository->employerReject($assignmentRequestTasker);
        }
    }

    public function guardStart(GuardEvent $event)
    {
        /** @var Task $task */
        $task = $event->getSubject();

        $event->setBlocked(! $this->taskRepository->taskCanStart($task));
    }

    public function guard(GuardEvent $event)
    {
        /** @var Task $task */
        $task = $event->getSubject();

        $event->setBlocked(! ($task->active || ($event->getTransition()->getName() === 'initiate')));
    }

    public function guardFinish(GuardEvent $event)
    {
        /** @var Task $task */
        $task = $event->getSubject();

        $event->setBlocked(! $this->taskRepository->taskCanFinish($task));
    }

    public function subscribe($events)
    {
        $events->listen('workflow.task.guard', 'App\Listeners\Workflow\TaskWorkflowListener@guard');
        $events->listen('workflow.task.guard.start', 'App\Listeners\Workflow\TaskWorkflowListener@guardStart');
        $events->listen('workflow.task.completed.send', 'App\Listeners\Workflow\TaskWorkflowListener@afterStartSending');
        $events->listen('workflow.task.completed.start', 'App\Listeners\Workflow\TaskWorkflowListener@afterStarted');
        $events->listen('workflow.task.completed.cancel', 'App\Listeners\Workflow\TaskWorkflowListener@afterCanceled');
        $events->listen('workflow.task.completed.finish', 'App\Listeners\Workflow\TaskWorkflowListener@afterFinished');
        $events->listen('workflow.task.completed.send_to_admin', 'App\Listeners\Workflow\TaskWorkflowListener@afterSentToAdmin');
        $events->listen('workflow.task.completed.accept', 'App\Listeners\Workflow\TaskWorkflowListener@afterAccept');
    }
}

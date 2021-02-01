<?php
/**
 * User: amir
 * Date: 2/17/20
 * Time: 12:53 AM
 */

namespace App\Listeners\Workflow;


use App\Models\AssignmentRequestTasker;
use App\Models\Auth\User;
use App\Models\Task;
use App\Notifications\EmployerAcceptedTasker;
use App\Notifications\EmployerRejectedTasker;
use App\Notifications\TaskerAcceptedTask;
use App\Notifications\TaskerRejectedTask;
use App\Notifications\TaskSentToTasker;
use App\Repositories\AssignmentRequestTaskerRepository;
use App\Repositories\TaskRepository;
use App\TaskerLocator\TaskerLocatorInterface;
use App\TaskerLocator\TaskerLocatorRegistry;
use Carbon\Carbon;
use Symfony\Component\Workflow\Event\CompletedEvent;
use Symfony\Component\Workflow\Event\GuardEvent;

class AssignmentRequestTaskerWorkflowListener
{
    /**
     * @var AssignmentRequestTaskerRepository
     */
    private $assignmentRequestTaskerRepository;

    /**
     * @var TaskRepository
     */
    private $taskRepository;

    public function __construct(
        AssignmentRequestTaskerRepository $assignmentRequestTaskerRepository,
        TaskRepository $taskRepository
    ) {
        $this->assignmentRequestTaskerRepository = $assignmentRequestTaskerRepository;
        $this->taskRepository = $taskRepository;
    }

    public function guardTaskerAccept(GuardEvent $event)
    {
        /** @var AssignmentRequestTasker $assignmentRequestTasker */
        $assignmentRequestTasker = $event->getSubject();

        if (!$this->assignmentRequestTaskerRepository->canRespondByTasker($assignmentRequestTasker)) {
            $event->setBlocked(true);
        }
    }

    public function guardTaskerReject(GuardEvent $event)
    {
        /** @var AssignmentRequestTasker $assignmentRequestTasker */
        $assignmentRequestTasker = $event->getSubject();

        if (!$this->assignmentRequestTaskerRepository->canRespondByTasker($assignmentRequestTasker)) {
            $event->setBlocked(true);
        }
    }

    public function guardEmployerAccept(GuardEvent $event)
    {
        /** @var AssignmentRequestTasker $assignmentRequestTasker */
        $assignmentRequestTasker = $event->getSubject();

        if (!$this->assignmentRequestTaskerRepository->canRespondByEmployer($assignmentRequestTasker)) {
            $event->setBlocked(true);
        }
    }

    public function guardEmployerReject(GuardEvent $event)
    {
        /** @var AssignmentRequestTasker $assignmentRequestTasker */
        $assignmentRequestTasker = $event->getSubject();

        if (!$this->assignmentRequestTaskerRepository->canRespondByEmployer($assignmentRequestTasker)) {
            $event->setBlocked(true);
        }
    }

    public function afterTaskerAccepted(CompletedEvent $event)
    {
        /** @var AssignmentRequestTasker $assignmentRequestTasker */
        $assignmentRequestTasker = $event->getSubject();
        $task = $assignmentRequestTasker->task;
        $this->taskRepository->update($task, ['last_tasker_accepted_at' => Carbon::now()]);
        $assignmentRequestTasker->task->employer->notify(new TaskerAcceptedTask($assignmentRequestTasker));

        if (!$task->hasPendingRequests()) {
            $this->taskRepository->send($task);
        }
    }

    public function afterTaskerRejected(CompletedEvent $event)
    {
        /** @var AssignmentRequestTasker $assignmentRequestTasker */
        $assignmentRequestTasker = $event->getSubject();
        $task = $assignmentRequestTasker->task;

        if (!$task->hasPendingRequests()) {
            $this->taskRepository->send($task);
        }

//        $assignmentRequestTasker->assignment_request->task->employer->notify(new TaskerRejectedTask($assignmentRequestTasker));
    }

    public function afterTaskerTimeout(CompletedEvent $event)
    {
        /** @var AssignmentRequestTasker $assignmentRequestTasker */
        $assignmentRequestTasker = $event->getSubject();
        $task = $assignmentRequestTasker->task;
        if (!$task->hasPendingRequests() && $task->status !== 'accepted') {
            $this->taskRepository->send($task);
        }
    }

    public function afterEmployerAccepted(CompletedEvent $event)
    {
        /** @var AssignmentRequestTasker $assignmentRequestTasker */
        $assignmentRequestTasker = $event->getSubject();
        $task = $assignmentRequestTasker->task;

        $assignmentRequestTasker->tasker->notify(new EmployerAcceptedTasker($assignmentRequestTasker));

        if ($this->taskRepository->allNeededTaskersBeenAccepted($task)) {
            $this->taskRepository->accept($task);
        } elseif(!$task->hasNotFinishedRequests()) {
            $this->taskRepository->send($task);
        }
    }

    public function afterEmployerRejected(CompletedEvent $event)
    {
        /** @var AssignmentRequestTasker $assignmentRequestTasker */
        $assignmentRequestTasker = $event->getSubject();

        $task = $assignmentRequestTasker->task;
        if ($task->status !== 'accepted' && !$task->hasNotFinishedRequests()) {
            $this->taskRepository->send($task);
        }

        $assignmentRequestTasker->tasker->notify(new EmployerRejectedTasker($assignmentRequestTasker));
    }

    public function afterPended(CompletedEvent $event)
    {
        /** @var AssignmentRequestTasker $assignmentRequestTasker */
        $assignmentRequestTasker = $event->getSubject();

        $assignmentRequestTasker->tasker->notify(new TaskSentToTasker($assignmentRequestTasker));
    }

    public function subscribe($events)
    {
        $events->listen(
            'workflow.assignment_request_tasker.guard.tasker_accept',
            'App\Listeners\Workflow\AssignmentRequestTaskerWorkflowListener@guardTaskerAccept'
        );
        $events->listen(
            'workflow.assignment_request_tasker.guard.tasker_reject',
            'App\Listeners\Workflow\AssignmentRequestTaskerWorkflowListener@guardTaskerReject'
        );
        $events->listen(
            'workflow.assignment_request_tasker.guard.employer_accept',
            'App\Listeners\Workflow\AssignmentRequestTaskerWorkflowListener@guardEmployerAccept'
        );
        $events->listen(
            'workflow.assignment_request_tasker.guard.employer_reject',
            'App\Listeners\Workflow\AssignmentRequestTaskerWorkflowListener@guardEmployerReject'
        );
        $events->listen(
            'workflow.assignment_request_tasker.completed.tasker_accept',
            'App\Listeners\Workflow\AssignmentRequestTaskerWorkflowListener@afterTaskerAccepted'
        );
        $events->listen(
            'workflow.assignment_request_tasker.completed.tasker_reject',
            'App\Listeners\Workflow\AssignmentRequestTaskerWorkflowListener@afterTaskerRejected'
        );
        $events->listen(
            'workflow.assignment_request_tasker.completed.tasker_timeout',
            'App\Listeners\Workflow\AssignmentRequestTaskerWorkflowListener@afterTaskerTimeout'
        );
        $events->listen(
            'workflow.assignment_request_tasker.completed.employer_accept',
            'App\Listeners\Workflow\AssignmentRequestTaskerWorkflowListener@afterEmployerAccepted'
        );
        $events->listen(
            'workflow.assignment_request_tasker.completed.employer_reject',
            'App\Listeners\Workflow\AssignmentRequestTaskerWorkflowListener@afterEmployerRejected'
        );
        $events->listen(
            'workflow.assignment_request_tasker.completed.pend',
            'App\Listeners\Workflow\AssignmentRequestTaskerWorkflowListener@afterPended'
        );
    }
}

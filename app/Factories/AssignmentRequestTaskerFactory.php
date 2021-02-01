<?php
/**
 * User: amir
 * Date: 2/17/20
 * Time: 1:06 AM
 */

namespace App\Factories;

use App\Models\AssignmentRequestTasker;
use App\Models\Auth\User;
use App\Models\Task;

class AssignmentRequestTaskerFactory
{
    public function create(Task $task, User $tasker)
    {
        return \DB::transaction(function () use ($task, $tasker) {
            $assignmentRequestTasker = new AssignmentRequestTasker();
            $assignmentRequestTasker->task()->associate($task);
            $assignmentRequestTasker->tasker()->associate($tasker);
            $assignmentRequestTasker->pend();

            return $assignmentRequestTasker;
        });
    }
}

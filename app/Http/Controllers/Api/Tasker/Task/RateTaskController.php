<?php

namespace App\Http\Controllers\Api\Tasker\Task;

use App\Factories\RatingFactory;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Employer\AssignmentRequestTasker\RateAssignmentRequestTaskerRequest;
use App\Http\Requests\Api\Tasker\Task\RateTaskRequest;
use App\Models\AssignmentRequestTasker;
use App\Models\Task;

class RateTaskController extends Controller
{
    public function __invoke(
        RateTaskRequest $request,
        Task $task,
        RatingFactory $ratingFactory
    ) {
        return response()->json(
            $ratingFactory->create($task, $request->rate, $request->comment, $this->user())
        );
    }
}

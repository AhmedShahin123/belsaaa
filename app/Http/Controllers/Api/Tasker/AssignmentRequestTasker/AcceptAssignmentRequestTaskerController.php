<?php

namespace App\Http\Controllers\Api\Tasker\AssignmentRequestTasker;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Tasker\AssignmentRequestTasker\AcceptAssignmentRequestTaskerRequest;
use App\Models\AssignmentRequestTasker;
use App\Repositories\AssignmentRequestTaskerRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AcceptAssignmentRequestTaskerController extends Controller
{
    public function __invoke(
        AcceptAssignmentRequestTaskerRequest $request,
        AssignmentRequestTasker $assignmentRequestTasker,
        AssignmentRequestTaskerRepository $assignmentRequestTaskerRepository
    ) {
        if (
            $assignmentRequestTasker->task->task_type === 'one_time' &&
            $assignmentRequestTaskerRepository->overlappingOneTimeRequest($assignmentRequestTasker)
        ) {
            return response()->json(['message' => __('exceptions.overlapped_with_other_request')], Response::HTTP_FORBIDDEN);
        }

        $assignmentRequestTaskerRepository->taskerAccept($assignmentRequestTasker);

        return response()->noContent();
    }
}

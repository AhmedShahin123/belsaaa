<?php

namespace App\Http\Controllers\Api\Tasker\AssignmentRequestTasker;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Tasker\AssignmentRequestTasker\RejectAssignmentRequestTaskerRequest;
use App\Models\AssignmentRequestTasker;
use App\Repositories\AssignmentRequestTaskerRepository;

class RejectAssignmentRequestTaskerController extends Controller
{
    public function __invoke(
        RejectAssignmentRequestTaskerRequest $request,
        AssignmentRequestTasker $assignmentRequestTasker,
        AssignmentRequestTaskerRepository $assignmentRequestTaskerRepository
    ) {
        $assignmentRequestTaskerRepository->taskerReject($assignmentRequestTasker);

        return response()->noContent();
    }
}

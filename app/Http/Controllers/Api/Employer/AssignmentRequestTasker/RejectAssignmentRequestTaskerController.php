<?php

namespace App\Http\Controllers\Api\Employer\AssignmentRequestTasker;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Employer\AssignmentRequestTasker\RejectAssignmentRequestTaskerRequest;
use App\Models\AssignmentRequestTasker;
use App\Repositories\AssignmentRequestTaskerRepository;
use Illuminate\Http\Request;

class RejectAssignmentRequestTaskerController extends Controller
{
    public function __invoke(
        RejectAssignmentRequestTaskerRequest $request,
        AssignmentRequestTasker $assignmentRequestTasker,
        AssignmentRequestTaskerRepository $assignmentRequestTaskerRepository
    ) {
        $assignmentRequestTaskerRepository->employerReject($assignmentRequestTasker);

        return response()->noContent();
    }
}

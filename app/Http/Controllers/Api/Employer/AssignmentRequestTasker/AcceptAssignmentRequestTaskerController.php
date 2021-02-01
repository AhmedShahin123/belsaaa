<?php

namespace App\Http\Controllers\Api\Employer\AssignmentRequestTasker;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Employer\AssignmentRequestTasker\AcceptAssignmentRequestTaskerRequest;
use App\Models\AssignmentRequestTasker;
use App\Repositories\AssignmentRequestTaskerRepository;
use Illuminate\Http\Request;

class AcceptAssignmentRequestTaskerController extends Controller
{
    public function __invoke(
        AcceptAssignmentRequestTaskerRequest $request,
        AssignmentRequestTasker $assignmentRequestTasker,
        AssignmentRequestTaskerRepository $assignmentRequestTaskerRepository
    ) {
        $assignmentRequestTaskerRepository->employerAccept($assignmentRequestTasker);

        return response()->noContent();
    }
}

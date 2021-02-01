<?php

namespace App\Http\Controllers\Api\Employer\AssignmentRequestTasker;

use App\Factories\RatingFactory;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Employer\AssignmentRequestTasker\RateAssignmentRequestTaskerRequest;
use App\Models\AssignmentRequestTasker;

class RateAssignmentRequestTaskerController extends Controller
{
    public function __invoke(
        RateAssignmentRequestTaskerRequest $request,
        AssignmentRequestTasker $assignmentRequestTasker,
        RatingFactory $ratingFactory
    ) {
        return response()->json(
            $ratingFactory->create($assignmentRequestTasker, $request->rate, $request->comment, $this->user())
        );
    }
}

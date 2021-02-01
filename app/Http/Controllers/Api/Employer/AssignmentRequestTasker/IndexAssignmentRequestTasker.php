<?php
/**
 * User: amir
 * Date: 3/10/20
 * Time: 2:40 PM
 */

namespace App\Http\Controllers\Api\Employer\AssignmentRequestTasker;


use App\Http\Controllers\Api\Controller;
use App\Repositories\AssignmentRequestTaskerRepository;
use Illuminate\Http\Request;

class IndexAssignmentRequestTasker extends Controller
{
    /**
     * @var AssignmentRequestTaskerRepository
     */
    private $assignmentRequestTaskerRepository;

    public function __construct(AssignmentRequestTaskerRepository $assignmentRequestTaskerRepository)
    {
        $this->assignmentRequestTaskerRepository = $assignmentRequestTaskerRepository;
    }

    public function __invoke(Request $request)
    {
        return $this->assignmentRequestTaskerRepository->paginateByEmployer($this->user(), $request->query->all());
    }
}

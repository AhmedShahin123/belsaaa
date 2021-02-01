<?php
/**
 * User: amir
 * Date: 3/10/20
 * Time: 2:40 PM
 */

namespace App\Http\Controllers\Api\Tasker\AssignmentRequestTasker;


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
        \DB::enableQueryLog();
        $result = $this->assignmentRequestTaskerRepository->paginateByTasker($this->user(), $request->query->all());
        \Log::info('IndexAssignmentRequestTasker query log', \DB::getQueryLog());

        return $result;
    }
}

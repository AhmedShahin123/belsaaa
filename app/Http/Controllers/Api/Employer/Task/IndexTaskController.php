<?php
/**
 * User: amir
 * Date: 2/26/20
 * Time: 2:07 PM
 */

namespace App\Http\Controllers\Api\Employer\Task;


use App\Http\Controllers\Api\Controller;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

class IndexTaskController extends Controller
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function __invoke(Request $request)
    {
        return $this->taskRepository->getForEmployerPaginated(
            $this->user(),
            25,
            'created_at',
            'desc',
            $request->query->all()
        );
    }
}

<?php
/**
 * User: amir
 * Date: 3/9/20
 * Time: 8:26 PM
 */

namespace App\Http\Controllers\Api\Employer\Task\Status;


use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexTaskStatusController
{
    public function __invoke()
    {
        $statuses = collect(Task::STATUSES);

        return new LengthAwarePaginator($statuses, $statuses->count(), $statuses->count());
    }
}

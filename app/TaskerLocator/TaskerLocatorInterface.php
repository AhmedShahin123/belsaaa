<?php
/**
 * User: amir
 * Date: 2/17/20
 * Time: 1:24 AM
 */

namespace App\TaskerLocator;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskerLocatorInterface
{
    public function support(Task $task): bool;

    public function locate(Task $task): Collection;
}

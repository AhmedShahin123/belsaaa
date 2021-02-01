<?php
/**
 * User: amir
 * Date: 2/17/20
 * Time: 1:32 AM
 */

namespace App\TaskerLocator;


use App\Models\Task;
use Illuminate\Support\Collection;

class TaskerLocatorRegistry
{
    /**
     * @var Collection
     */
    private $taskerLocators;

    public function __construct()
    {
        $this->taskerLocators = new Collection();;
    }

    public function registerTaskerLocator(TaskerLocatorInterface $taskerLocator)
    {
        $this->taskerLocators[] = $taskerLocator;
    }

    public function getLocator(Task $task): TaskerLocatorInterface
    {
        return $this->taskerLocators->filter(function (TaskerLocatorInterface $taskerLocator) use ($task) {
            return $taskerLocator->support($task);
        })->first();
    }
}

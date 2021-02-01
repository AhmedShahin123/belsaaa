<?php
/**
 * User: amir
 * Date: 2/1/20
 * Time: 10:56 PM
 */

namespace App\Factories;

use App\Events\TaskCreated;
use App\Models\Auth\User;
use App\Models\Task;
use Carbon\Carbon;
use Webmozart\Assert\Assert;

class TaskFactory
{
    /**
     * @var TaskOneTimeAttributesFactory
     */
    private $oneTimeAttributesFactory;

    /**
     * @var TaskRepeatedAttributesFactory
     */
    private $repeatedAttributesFactory;

    /**
     * @var TaskContinuedAttributesFactory
     */
    private $continuedAttributesFactory;

    public function __construct(
        TaskOneTimeAttributesFactory $oneTimeAttributesFactory,
        TaskRepeatedAttributesFactory $repeatedAttributesFactory,
        TaskContinuedAttributesFactory $continuedAttributesFactory
    ) {
        $this->oneTimeAttributesFactory = $oneTimeAttributesFactory;
        $this->repeatedAttributesFactory = $repeatedAttributesFactory;
        $this->continuedAttributesFactory = $continuedAttributesFactory;
    }

    public function initialize(array $data = [], array $attributes = [], User $user = null)
    {
        $task = new Task();
        $task->fill($data);
        $task->employer()->associate($user);
        $task->task_attributes()->associate($this->initializeAttributes($task->task_type, $attributes));

        return $task;
    }

    public function create(array $data, array $attributes, User $user): Task
    {
        Assert::true($user->user_type == 'employer');

        return \DB::transaction(function() use ($data, $attributes, $user) {
            $task = new Task();
            $task->fill($data);
            $task->employer()->associate($user);
            $task->task_attributes()->associate($this->createAttributes($task->task_type, $attributes));
            $task->fill([
                'start_at' => Carbon::createFromFormat('Y-m-d H:i:s', $task->task_attributes->getStartAt()),
                'end_at' => Carbon::createFromFormat('Y-m-d H:i:s', $task->task_attributes->getEndAt()),
            ]);
            $task->initiate();

            event(new TaskCreated($task));

            return $task;
        });
    }

    protected function createAttributes(string $taskType, array $attributes)
    {
        switch ($taskType) {
            case 'one_time':
                return $this->oneTimeAttributesFactory->create($attributes);
            case 'repeated':
                return $this->repeatedAttributesFactory->create($attributes);
            case 'continued':
                return $this->continuedAttributesFactory->create($attributes);
            default:
                throw new \InvalidArgumentException();
        }
    }

    protected function initializeAttributes(string $taskType, array $attributes)
    {
        switch ($taskType) {
            case 'one_time':
                return $this->oneTimeAttributesFactory->initialize($attributes);
            case 'repeated':
                return $this->repeatedAttributesFactory->initialize($attributes);
            case 'continued':
                return $this->continuedAttributesFactory->initialize($attributes);
            default:
                throw new \InvalidArgumentException();
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Console\Command;

/**
 * @deprecated
 */
class RejectPassedNotAcceptedTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:reject_passed_tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * Create a new command instance.
     *
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        parent::__construct();
        $this->taskRepository = $taskRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $query = $this->taskRepository->passedAndNotAccepted();
        $query->chunk(100, function ($tasks) {
            /** @var Task $task */
            foreach ($tasks as $task) {
                $this->taskRepository->reject($task);
            }
        });
    }
}

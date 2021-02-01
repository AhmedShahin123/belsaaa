<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Console\Command;

class ExpireTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire tasks without accepted tasker by employer';

    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * Create a new command instance.
     *
     * @return void
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
        $query = $this->taskRepository->passedEndAtWithoutAcceptedTaskerQuery();
        $query->chunk(100, function ($tasks) {
            /** @var Task $task */
            foreach ($tasks as $task) {
                $this->taskRepository->expire($task);
            }
        });
    }
}

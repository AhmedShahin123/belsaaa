<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Console\Command;

class SendTasksToTaskers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends tasks to taskers that is ready for send';

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
     */
    public function handle()
    {

        $query = $this->taskRepository->byStartWithinQuery();
        $bar = $this->output->createProgressBar($query->count());

        $bar->start();

        $query->chunk(100, function ($tasks) use ($bar) {
            /** @var Task $task */
            foreach ($tasks as $task) {
                $this->taskRepository->send($task);
                $bar->advance();
            }
        });

        $bar->finish();
    }
}

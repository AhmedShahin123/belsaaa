<?php

namespace App\Console\Commands;

use App\Repositories\TaskRepository;
use Illuminate\Console\Command;

class SendToAdminEmployerNotAnswered extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:send_to_admin';

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
        $query = $this->taskRepository->byUnansweredByEmployerQuery();
        $bar = $this->output->createProgressBar($query->count());
        $bar->start();
        $query->chunk(100, function ($tasks) use ($bar) {
            foreach ($tasks as $task) {
                $this->taskRepository->sendToAdmin($task);
                $bar->advance();
            }
        });

        $bar->finish();
    }
}

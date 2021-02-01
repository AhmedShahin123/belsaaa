<?php

namespace App\Console\Commands;

use App\Models\AssignmentRequestTasker;
use App\Models\Task;
use App\Repositories\AssignmentRequestTaskerRepository;
use Illuminate\Console\Command;

class RejectTaskerNotAnswered extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assignment_request_tasker:reject_tasker_pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var AssignmentRequestTaskerRepository
     */
    private $assignmentRequestTaskerRepository;

    /**
     * Create a new command instance.
     *
     * @param AssignmentRequestTaskerRepository $assignmentRequestTaskerRepository
     */
    public function __construct(AssignmentRequestTaskerRepository $assignmentRequestTaskerRepository)
    {
        parent::__construct();
        $this->assignmentRequestTaskerRepository = $assignmentRequestTaskerRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $query = $this->assignmentRequestTaskerRepository->byUnansweredByTaskerQuery();
        $bar = $this->output->createProgressBar($query->count());
        $bar->start();
        $query->chunk(100, function ($assignmentRequestTaskers) use ($bar) {
            /** @var AssignmentRequestTasker $assignmentRequestTasker */
            foreach ($assignmentRequestTaskers as $assignmentRequestTasker) {
                $this->assignmentRequestTaskerRepository->taskerTimeout($assignmentRequestTasker);
                $bar->advance();
            }
        });
        $bar->finish();
        $this->output->writeln('');
    }
}

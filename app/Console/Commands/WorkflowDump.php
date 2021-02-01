<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Workflow\Dumper\GraphvizDumper;
use Symfony\Component\Workflow\Dumper\PlantUmlDumper;
use Symfony\Component\Workflow\Dumper\StateMachineGraphvizDumper;
use Symfony\Component\Workflow\Marking;
use Symfony\Component\Workflow\Registry;

class WorkflowDump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workflow:dump {model} {--dump-format=} {--label=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var Registry
     */
    private $registry;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Registry $registry)
    {
        parent::__construct();
        $this->registry = $registry;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $model = $this->input->getArgument('model');

        $workflow = $this->registry->get(new $model);

        if ('puml' === $this->input->getOption('dump-format')) {
            $dumper = new PlantUmlDumper(PlantUmlDumper::STATEMACHINE_TRANSITION);
        } else {
            $dumper = new StateMachineGraphvizDumper();
        }

        $marking = new Marking();

        $options = [
            'name' => $model,
            'nofooter' => true,
            'graph' => [
                'label' => $this->input->getOption('label'),
            ],
        ];
        $this->output->writeln($dumper->dump($workflow->getDefinition(), $marking, $options));

        return 0;
    }
}

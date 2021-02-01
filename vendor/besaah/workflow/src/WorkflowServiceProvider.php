<?php
/**
 * User: amir
 * Date: 5/30/19
 * Time: 8:39 AM
 */

namespace BeSaah;


use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Workflow\Definition;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Workflow\MarkingStore\MethodMarkingStore;
use Symfony\Component\Workflow\MarkingStore\MultipleStateMarkingStore;
use Symfony\Component\Workflow\MarkingStore\SingleStateMarkingStore;
use Symfony\Component\Workflow\Metadata\InMemoryMetadataStore;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\StateMachine;
use Symfony\Component\Workflow\SupportStrategy\InstanceOfSupportStrategy;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Workflow\Workflow;

class WorkflowServiceProvider extends ServiceProvider
{
    public function register()
    {
        $config = config('workflow');
        $processor = new Processor();
        $workflowConfig = new WorkflowConfig();
        $processedConfiguration = $processor->processConfiguration(
            $workflowConfig,
            ['workflow' => $config]
        );
        $processedConfiguration = $processedConfiguration['workflows'];

        $this->app->singleton(Registry::class, function (Application $app) use ($processedConfiguration) {
            $registry = new Registry();
            if (!$processedConfiguration['enabled']) {
                return $registry;
            }

            foreach ($processedConfiguration['workflows'] as $name => $workflow) {
                $placesMetadata = [];
                foreach ($workflow['places'] as $place) {
                    if ($place['metadata']) {
                        $placesMetadata[$place['name']] = $place['metadata'];
                    }
                }

                $transitions = [];
                $transitionsMetadata = new \SplObjectStorage();

                foreach ($workflow['transitions'] as $transition) {
                    foreach ($transition['from'] as $from) {
                        foreach ($transition['to'] as $to) {
                            $transitionObj = new Transition($transition['name'], $from, $to);
                            $transitions[] = $transitionObj;
                            if ($transition['metadata']) {
                                $transitionsMetadata->attach(
                                    $transitionObj,
                                    $transition['metadata']
                                );
                            }
                        }
                    }
                }
                $metadataStore = new InMemoryMetadataStore($workflow['metadata'], $placesMetadata, $transitionsMetadata);

                // Create places
                $places = array_column($workflow['places'], 'name');

                $workflowDefinition = new Definition($places, $transitions, $workflow['initial_place'], $metadataStore);

                $markingStoreProperty = $workflow['marking_store']['property'];
                $markingStore = new MethodMarkingStore($workflow['marking_store']['type'] == 'single_state', $markingStoreProperty);

                $dispatcher = new EventDispatcherAdapter($app->get(Dispatcher::class));
                $stateMachine = new StateMachine($workflowDefinition, $markingStore, null, $name);
                $reflection = new \ReflectionClass(Workflow::class);
                $property = $reflection->getProperty('dispatcher');
                $property->setAccessible(true);
                $property->setValue($stateMachine, $dispatcher);


                foreach ($workflow['supports'] as $supportedClassName) {
                    $registry->addWorkflow($stateMachine, new InstanceOfSupportStrategy($supportedClassName));
                }
            }

            return $registry;
        });

        $this->app->alias(Registry::class, 'workflow.registry');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/workflow.php' => config_path('workflow.php'),
        ]);
    }
}

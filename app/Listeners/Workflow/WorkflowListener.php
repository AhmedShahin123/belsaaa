<?php
/**
 * User: amir
 * Date: 2/17/20
 * Time: 1:02 AM
 */

namespace App\Listeners\Workflow;


use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Workflow\Event\EnteredEvent;

class WorkflowListener
{
    public function afterEntered(EnteredEvent $event)
    {
        $subject = $event->getSubject();

        if ($subject instanceof Model) {
            $subject->save();
        }
    }

    public function subscribe($events)
    {
        $events->listen('workflow.entered', 'App\Listeners\Workflow\WorkflowListener@afterEntered');
    }
}
